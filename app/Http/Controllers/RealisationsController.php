<?php

namespace App\Http\Controllers;

use App\Events\CreationNouvelleRealisation;
use App\Models\Realisations;
use App\Models\Subcategory;
use App\Models\User;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FileController;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

use App\Http\Resources\RealisationsResource;
use App\Models\Image;
use App\Models\File;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
//use Nette\Utils\Arrays;

class RealisationsController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function allRealisations()
    {
        //return  RealisationsResource::collection(Realisations::all());
        $realisation = Realisations::all();
        return [
            'data' => RealisationsResource::collection(Realisations::all()),
            'total' => Realisations::all()->count()
        ];
    }

    public function getAllRealisationsValide()
    {
        return [
            'data' => RealisationsResource::collection(Realisations::where('valide', '=', true)->get()),
            'total' => Realisations::where('valide', '=', true)->count(),
        ];
        //return Realisations::where('valide', '=', true)->count();
    }
    public function getAllRealisationsNoValide()
    {
        return [
            'data' => RealisationsResource::collection(Realisations::where('valide', '=', false)->get()),
            'total' => Realisations::where('valide', '=', false)->count()
        ];
    }

    // api/v1/users/{user}/subcategories/{subcategory}/realisations
    public function index($user_id, $subcategory_id)
    {
        return  RealisationsResource::collection(Realisations::where('user_id', $user_id)->where('subcategory_id', $subcategory_id)->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //api/v1/users/{user}/subcategories/{subcategory}/realisations 
    public function store(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $realisation = new Realisations(array(
            'title' => $request->title,
            'description' => $request->description,
            'nbr_vue' => 0,
            'valide' => false, 
           
            'user_id' => $user->id,
        ));
       
        $realisation->save();
        DB::beginTransaction();

        try {
        $realisation->tags()->attach(json_decode($request->tags));
        if ($request->images != null) {
            $images = json_decode($request->images);
            foreach ($images as $img) {
                $filename = $img->fileRecord->file->name;
                $size = $img->fileRecord->size;
                $url = $img->data->secure_url;
                $public_id = $img->data->public_id;
                $data = cloudinary()->uploadApi()->explicit($public_id, [
                    "type" => "upload",
                    "eager" => [
                        ["width" => 200, "height" => 125,],
                        ["width" => 312, "height" => 176,],
                        ["width" => 950, "height" => 450,],
                    ]
                ]);
                // array_unshift($slides, ['media' => $public_id]);
                $slides[] = ['media'  => 'i:' . $public_id];
                $image = new Image(array(
                    'name_img' => $filename,
                    'format' => $data['format'],
                    'url' => $data['url'],
                    'secure_url' => $data['secure_url'],
                    'size' => $data['bytes'],
                    'width' => $data['width'],
                    'height' => $data['height'],
                    'public_id' => $public_id,
                    'variants' => ["small" => $data['eager'][0], "medium" => $data['eager'][1], "hight" => $data['eager'][2]], //$data['eager'],
                    'size' => $data['bytes'],
                    'type_model' => 'images',
                    // 'imageable_id'=>'', 
                    // 'imageable_type'=>'',
                ));
                // $realisation->images()->save($image);
            }
        }
        //s'il y a des docs

        if ($request->docs) {
            $docs = json_decode($request->docs);
            foreach ($docs as $doc) {
                $filename = $doc->data->original_filename;
                $public_id = $doc->data->public_id;
                $result = cloudinary()->search()->expression('public_id=' . $public_id)->maxResults(1)->execute();
                $data = $result['resources'][0];
                // return $result['resources'][0];
                $newdoc = new File(array(
                    'name_file' => $filename,
                    'format' => $data['format'],
                    'url' => $data['url'],
                    'secure_url' => $data['secure_url'],
                    'size' => $data['bytes'],
                    'width' =>/* $data['width'] || */ '',
                    'variants' => [],
                    'height' => /*$data['height'] || */ '',
                    'public_id' => $public_id,
                    'type_model' => 'documents',
                    //'url'=>  $url,
                ));

                $realisation->documents()->save($newdoc);
            }
        }

        //s'il y aun poster 

       
        if ($request->poster) {
            $posters = json_decode($request->poster);
            foreach ($posters as $poster) {
                //return $poster->data->;
                $filename = $poster->data->original_filename;
                // $extension =$img->fileRecord->file->type;
                $size = $poster->fileRecord->size;
                $url = $poster->data->secure_url;
                $public_id = $poster->data->public_id;
                $data = cloudinary()->uploadApi()->explicit($public_id, [
                    "type" => "upload",
                    "eager" => [
                        ["width" => 200, "height" => 125,],
                        ["width" => 312, "height" => 176,],
                        ["width" => 950, "height" => 450,],

                    ]
                ]);

                $poster = new Image(array(
                    'name_img' => $filename,
                    'url' => $data['url'],
                    'format' => $data['format'],
                    'secure_url' => $data['secure_url'],
                    'size' => $data['bytes'],
                    'width' => $data['width'],
                    'height' => $data['height'],
                    'public_id' => $public_id,
                    'variants' => ["small" => $data['eager'][0], "medium" => $data['eager'][1], "hight" => $data['eager'][2]], //$data['eager'],,//$size,
                    'type_model' => 'poster',
                    // 'imageable_id'=>'', 
                    // 'imageable_type'=>'',
                ));
                $realisation->poster()->save($poster);
            }
        }

        // si il y a un fichier

        if ($request->video) {
            // $posters = json_decode($request->video);
            $videos = json_decode($request->video);
            foreach ($videos as $video) {
                $filename = $video->data->original_filename;
                // $extension =$img->fileRecord->file->type;
                $size = $video->fileRecord->size;
                $url = $video->data->secure_url;
                $public_id = $video->data->public_id;
                $data = cloudinary()->uploadApi()->explicit($public_id, [
                    "resource_type" => "video",
                    "type" => "upload", //image_metadata
                    "image_metadata" => true,
                    "eager" => [
                        ["width" => 200, "height" => 125, "format" => "mp4"],
                        ["width" => 200, "height" => 125, "format" => "ogv"],
                        ["width" => 200, "height" => 125, "format" => "webm"],
                        ["width" => 312, "height" => 176, "format" => "mp4"],
                        ["width" => 312, "height" => 176, "format" => "webm"], //webm
                        ["width" => 312, "height" => 176, "format" => "ogv"],
                        ["width" => 950, "height" => 450, "format" => "mp4"],
                        ["width" => 950, "height" => 450, "format" => "ogv"],
                        ["width" => 950, "height" => 450, "format" => "webm"],
                        //ogv
                    ]
                ]);
                $small = [$data['eager'][0], $data['eager'][1], $data['eager'][2]];
                $medium = [$data['eager'][3], $data['eager'][4], $data['eager'][5]];
                $hight = [$data['eager'][6], $data['eager'][7], $data['eager'][8]];

                //return $data['duration'];
                $video = new File(array(
                    'name_file' => $filename, //+$data['format'],
                    'format' => $data['format'],
                    'url' => $data['url'],
                    'duration' => $data['duration'],
                    'secure_url' => $data['secure_url'],
                    'size' => $data['bytes'],
                    'width' => $data['width'],
                    'height' => $data['height'],
                    'public_id' => $public_id,
                    'variants' => ["small" => $small, "medium" => $medium, "hight" => $hight,], //$data['eager'],
                    'type_model' => 'video',
                ));
            }
            $realisation->video()->save($video);
        }
        broadcast(new CreationNouvelleRealisation($realisation))->toOthers();

        $response = response()->json([
            'message' => 'Projet créé avec succès',
            new RealisationsResource($realisation)
        ], 201);

        return $response;
        DB::commit();
    } catch (QueryException $e) {
        // Annuler la transaction
        DB::rollBack();
       return $e;
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Realisations  $realisations
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $realisation = Realisations::find($id);
        if (!$realisation) {
            $response = response()->json([
                'error' => [
                    'message' => 'This  realisation cannot be found.'
                ]
            ], 404);
            return $response;
        }

        $response = new RealisationsResource($realisation);
        // $request->visitor()->visit($realisation);
        return $response;
    }

    public function getRealisationsByUser(Request $request, $userId)
    {
        // RealisationsResource::collection(Realisations::where('user_id','=',$userId)->get()),
        $realisation = Realisations::where('user_id', '=', $userId)->where('valide', true)->get();
        if (!$realisation) {
            $response = response()->json([
                'error' => [
                    'message' => 'This  realisation cannot be found.'
                ]
            ], 404);
            return $realisation;
        }

        $realisations = RealisationsResource::collection($realisation);
        return $realisations;
    }

    public function getRealisationsByTagFirsts(Request $request, $realisationId)
    {
        $realisation = Realisations::find($realisationId);

        //$realisation->wherePivotIn('priority', [1, 2]);
        if (!$realisation) {
            $response = response()->json([
                'error' => [
                    'message' => 'This  realisation cannot be found.'
                ]
            ], 404);
            return $realisation;
        }
        /* $tagsids=$realisation->tags()->get();
            $tab=[];
            foreach ($tagsids as $ele) {
                $tab[] = $ele->id;
            }*/
        /*  $tags = DB::table('realisations')->where('id',$realisationId)
            ->join('tags', 'users.id', '=', 'contacts.user_id')
            ->join('orders', 'users.id', '=', 'orders.user_id')
            ->select('users.*', 'contacts.phone', 'orders.price')
            ->pluck('title');

            DB::table('realisations')
        ->join('tags', function ($join) {
            $join->on('realisations.id', '=', 'tags.realisation_id')
                 ->where('contacts.user_id', '>', 5);
        })
        ->get();*/
        $tags = DB::table('realisationtags')
            ->where('realisation_id', $realisationId)
            ->pluck('tag_id');
        // $tags=Tag::where('name', 'LIKE', '%i%')->pluck('name');
        // return $tags;
        return  RealisationsResource::collection(Realisations::whereHas('tags', function ($query) use ($tags) {
            $query->whereIn('tag_id', $tags);
        })->latest()
            ->limit(10)->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Realisations  $realisations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        /*  if ((!$request->name_cat) || (!$request->description)) {
            $response = response()->json(['error' => ['message' => 'Please enter all required fields']], 422);
            return $response;
        }*/

        $realisation = Realisations::find($id);
        $realisation->update($request->all());
        /*$category->description = $request->description;
        $category->active =$request->active;
        $category->save();*/
        $response = response()->json([
            'message' => 'The category has been updated succesfully',
            new RealisationsResource($realisation)
        ], 201);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Realisations  $realisations
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $realisation = Realisations::find($id);
        if (!$realisation) {
            $response = response()->json([
                'error' => [
                    'message' => 'The realisation cannot be found.'
                ]
            ], 404);

            return $response;
        }

        Realisations::destroy($id);

        $response = response()->json([
            'message' => 'The realisation has been deleted.'
        ], 200);

        return $response;
    }


    public function like($realisationId, $userId)
    {
        $realisation = Realisations::find($realisationId);
        $user = User::find($userId);
        $user->realisationReactions()->attach($realisationId, ['like' => true, 'dislike' => false]);
        $result = $realisation->update(['nbrLikes' => $realisation->nbrLikes + 1]);
        $response = response()->json([
            'message' => $realisation->nbrLikes,
            $result
        ], 201);
        return $response;
    }

    public function unlike($realisationId, $userId)
    {
        $realisation = Realisations::find($realisationId);
        $user = User::find($userId);
        $user->realisationReactions()->detach($realisationId);
        $result = $realisation->update(['nbrLikes' => $realisation->nbrLikes - 1]);
        $response = response()->json([
            'message' => $realisation->nbrLikes,
            $result
        ], 201);
        return $response;
    }

    public function dislike($realisationId, $userId)
    {
        $realisation = Realisations::find($realisationId);
        $user = User::find($userId);
        $user->realisationReactions()->attach($realisationId, ['like' => false, 'dislike' => true]);
        $result = $realisation->update(['nbrdisLikes' => $realisation->nbrdisLikes + 1]);
        $response = response()->json([
            'message' => $realisation->nbrdisLikes,
            $result
        ], 201);
        return $response;
    }

    public function undislike($realisationId, $userId)
    {
        $realisation = Realisations::find($realisationId);
        $user = User::find($userId);
        $user->realisationReactions()->detach($realisationId);
        $result = $realisation->update(['nbrdisLikes' => $realisation->nbrdisLikes - 1]);
        $response = response()->json([
            'message' => $realisation->nbrdisLikes,
            $result
        ], 201);
        return $response;
    }

    public function my_notification_endpoint(Request $request, $id)
    {

        $realisation = Realisations::find($id);

        $vide = new Image(array(
            'name_img' => '$filename',
            'url' => $request->url,
            'format' => $request->format,
            'secure_url' => $request->secure_url,
            'size' => $request->bytes,
            'width' => $request->width,
            'height' => $request->height,
            'public_id' => $request->public_id,
            'variants' => [], //$data['eager'],,//$size,
            'type_model' => 'images',
            // 'imageable_id'=>'', 
            // 'imageable_type'=>'',
        ));
        $realisation->images()->save($vide);

        $response = response()->json([
            'message' => "genial",
        ], 201);
        return $response;
    }

    public function getRealisationsForUser(Request $request, $userId)
    {
        return  RealisationsResource::collection(Realisations::where('user_id', $userId)->where('active', 1)->orderBy($request->sortField/* || 'id'*/, $request->sortOrder != null ? $request->sortOrder : 'asc')->paginate($request->results));
    }

    public function getRealisationsPaginate(Request $request)
    {
        return  RealisationsResource::collection(Realisations::where('valide', 1)->paginate(6));
    }



    public function getAllRealisationsValideSearch(Request $request)
    {

        $entity_id = $request->entity;
        $filiere_id = $request->filiere;
        $tags = Tag::where('name', 'LIKE', '%' . $request->search . '%')->pluck('id');
        $realisations = Realisations::where('valide', '=', true)
            ->where('title', 'LIKE', '%' . $request->search . '%')->orwhereHas('tags', function ($query) use ($tags) {
                $query->whereIn('tag_id', $tags);
            });
            
        //return RealisationsResource::collection($realisations->orderBy($this->orderBySearchAttribute($request->order),$this->orderBySearchOrder($request->order))->get());
        if ($entity_id!=null) {
            return $realisations->user()->where(/*'user', */function (Builder $query)  use($entity_id){
                $query->student()->where(function (Builder $query)  use($entity_id){
                    $query->where('entity_id', '=',$entity_id);
                });
            })->get();
           // $realisations->where('entity_id', $entity_id);
            // return RealisationsResource::collection($realisations->orderBy($this->orderBySearchAttribute($request->order), $this->orderBySearchOrder($request->order))->get());
        }
        if ($filiere_id!=null) {
            $realisations->whereHas('user', function (Builder $query)  use($filiere_id){
                $query->whereHas('student', function (Builder $query)  use($filiere_id){
                    $query->where('filiere_id', '=', $filiere_id);
                });
            });
           // $realisations->where('filiere_id', $filiere_id);
        }
    return  RealisationsResource::collection($realisations->orderBy($this->orderBySearchAttribute($request->order), $this->orderBySearchOrder($request->order))->get()/*->paginate(6)*/);
    }
    public function orderBySearchAttribute($order)
    {
        switch ($order) {
            case 'lastest':
                $choice = 'created_at';
                break;
            case 'trending':
                $choice = 'nbrLikes';
                break;

            default:
                $choice = 'id';
                break;
        }
        return  $choice;
    }
    public function orderBySearchOrder($order)
    {
        switch ($order) {
            case 'lastest':
                $choice = 'desc';
                break;
            case 'trending':
                $choice = 'desc';
                break;

            default:
                $choice = 'asc';
                break;
        }
        return  $choice;
    }
}
