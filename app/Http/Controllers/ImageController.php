<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Realisations;
use Illuminate\Http\Request;
class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($realisation_id)
    {
        $realisation = Realisations::findOrFail($realisation_id);
        //$user = User::where('facebook_id', $data->id)->first();
        $images = Image::where('imageable_id', $realisation_id)->where('imageable_type', get_class($realisation))->get();
        return $images;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $realisation_id)
    {
        $realisation = Realisations::findOrFail($realisation_id);
        $images = $request->file('images');
        $json = array(
            'files' => array()
        );

        foreach ($images as $image) {

            $destination = 'public/images';
            $size = $image->getSize();
            $imagename = $image->getClientOriginalName();
            $extension = $image->extension();
            $fullName = $imagename . '.' . $extension;
            $pathToFile = $destination . '/' . $fullName;
            $upload_success = $realisation->images()->save($destination . '/' . $fullName);

            if ($upload_success) {
                $json['files'][] = array(
                    'name' => $imagename,
                    'size' => $size,
                    'url' => $pathToFile,
                    'message' => 'Uploaded successfully'
                );
                return response()->json($json);
            } else {
                $json['files'][] = array(
                    'message' => 'error uploading images',
                );
                return response()->json($json, 202);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        
    }

}
 /* $offre = Offre::find($id);
        $lignesPostulants = DB::table('postuler')
        ->where('offre_id',$offreId)->get();
           foreach ($lignesPostulants  as  $lignePostulant) {
            $realisation = Realisations::find($lignePostulant->realisation_id);
            $lignePostulant->realisation=$realisation;
            $user= User::find($lignePostulant->user_id);
            $lignePostulant->user=new UserResource($user);
           }
          // $lignesPostulants=json_decode(json_encode($lignesPostulants), true);
          //$total=count(json_decode(json_encode($lignesPostulants), true));
         /* $results=[];
            foreach($lignesPostulants as $cle1=> $lignePostulant1) {
                $lignePostulant1->projets=[$lignePostulant1->realisation];
               // return  $lignesPostulant->realisation;
               foreach ($lignesPostulants as  $cle2=> $lignePostulant2) {
                if($cle1!=$cle2){
                    if($lignePostulant1->user_id== $lignePostulant1->user_id && $lignePostulant1->offre_id==$lignePostulant2->offre_id){
                     
                        array_push($lignePostulant1->projets,$lignePostulant2->realisation);
                       // return ($lignesPostulants[$cle1]);                      
                      unset($lignesPostulants[$cle2]);
                    } 
                  }
                  
               }*/
               //return $lignesPostulants;
               //unset($lignePostulant2);
         //   }
           
        
            /*for ($i=0; $i < $total; $i++) { 
              
               $lignesPostulants[$i]['projets']=array();
               array_push($lignesPostulants[$i]['projets'],$lignesPostulants[$i]['realisation']);
               for ($j=0; $j < $total; $j++) { 
                  if($i!=$j){
                    if( $lignesPostulants[$i]['user_id']== $lignesPostulants[$j]['user_id'] && $lignePostulant[$i]['offre_id']==$lignePostulant[$j]['offre_id']){
                        array_push($lignesPostulants[$i]['projets'],$lignesPostulants[$j]['realisation']);
                        unset($lignesPostulants[$j]);
                    } 
                  }
               }
            }*/
                      /* foreach ($lignesPostulants  as  $lignePostulant) {
                        foreach ($lignePostulants as $ligne2) {
                           if( $lignePostulant->user_id==$ligne2->user_id && $lignePostulant->offre_id==$ligne2->offre_id){
            
                           }
                        }
                       }*/
                       /*foreach ($lignesPostulants  as  $lignePostulant) {
            
                        $realisation = Realisations::find($lignePostulant->realisation_id);
                        $lignePostulant->realisation=$realisation;
                        $user= User::find($lignePostulant->user_id);
                        $lignePostulant->user=new UserResource($user);
                       }*/




                       public function index()
    {

        return CuriculumVResource::collection(CuriculumV::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $CuriculumV = new CuriculumV(array(
            //'poste','company_name','date_deb','date_fin',''description'','student_id'
            'link' => $request->link,
          
        ));
        
        $CuriculumV->save();

        $response = response()->json([
            'message' => 'The CuriculumV has been created succesfully',
           'CuriculumV'=> new      CuriculumVResource($CuriculumV)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CuriculumVs  $CuriculumVs
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
       /* $student=  Student::find($studentId);
        if (!$student) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  user cannot be found.'
                ]
            ], 404);
            return $response;
        }*/
        $CuriculumV= CuriculumV::find($id);
        if (!  $CuriculumV) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        //$response = new UserResource($user);
        return $response = response()->json([
            'message' => 'The user has been found',
           'infos'  => new CuriculumVResource($CuriculumV)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CuriculumVs  $CuriculumVs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
      /*  $student = Student::find($studentId);
         if (!$student) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  user cannot be found.'
                ]
            ], 404);
            return $response;
        }*/
        $CuriculumV= CuriculumV::find($id);
        if (! $CuriculumV) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        $CuriculumV->update($request->all());

        $response = response()->json([
            'message' => 'The infos has been updated succesfully',
           'infos'  => new CuriculumVResource($CuriculumV),
        ], 201);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CuriculumVs  $CuriculumVs
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
      /*  $student = Student::find($studentId);
        if (!$student) {

           $response = response()->json([
               'error' => [
                   'message' => 'This  user cannot be found.'
               ]
           ], 404);
           return $response;
       }*/
       $CuriculumV= CuriculumV::find($id);

       CuriculumV::destroy($CuriculumV->id);
       
       $response = response()->json([
       'message' => 'The indos has been deleted.'
       ], 200);
      
      return $response;
    }







       //$offreV=$request->offre;
    
   // return //Redis::HEXISTS($request->index,'title');
   $list = Redis::lrange('offres_'.$id, 0, -1);

   // Chercher l'ID de hash en question dans la liste
   //$index = $request->index;
   //$index = Redis::lsearch('offres_'.$id, $request->index, 0, -1, true);
   $id_to_find =  $request->index;
   //$index = Redis::lsearch('offres_'.$id, $id_to_find, 0, -1, true);
   
   //return $index;
   $list = Redis::lrange('offres_'.$id, 0, -1);
   if (in_array($id_to_find, $list)) {
       // L'ID de hash a été trouvé dans la liste à l'index $index
   
       // Définir toutes les clés et valeurs du hash
       $result=Redis::hmset($id_to_find,['offre'=>json_encode($request->offre)]);
   }else{
      Redis::HSET($request->index,'offre',json_encode($request->offre));
       $result=Redis::LPUSH('offres_'.$id,$request->index);
   }
   return $result;
   
      if(Redis::HEXISTS($request->index)){
       $offre=Redis::HSET($request->index, $request->offre); 
      } else{
       $offre=Redis::HSETNX($request->index, $request->offre); 
      }
     return $offre;
   
     return  $result=Redis::LPUSH('offres_'.$id,$request->index);
     //  $offre=Redis::HSET($offreV->index,$offreV);  
   
       if( $offre->index!=null){   
           $success1=Redis::LSET('offres_'.$id,$offre->index,$offre);   
       }else{ 
          // return $request->offre;   
          //return  $lenght=Redis::LLEN('offres_'.$id)+1;   
           $offre->index= $lenght=Redis::LLEN('offres_'.$id); 
          
           $success1=Redis::LPUSH('offres_'.$id,json_encode($offre));
           //$success1=Redis::LSET('offres_'.$id,$request->offre->index,$request->offre); 
       }
   
       return [
           'offre'=>$offre,
       ];
      // $ele=Redis::LINDEX('offres_'.$id,0);
   
       //Redis::LRANGE('offres_'.$id);
      // $lenght=Redis::LSET('offres_'.$id,0,);
       
       $lenght=Redis::LLEN('offres_'.$id);//taille de la liste
      // $result=Redis::LPUSH('offres_'.$id,json_encode($request->offre));//ajouter un élément à la liste
   
       return $lenght;
          /* $cachedOffre= Redis::get('offre_' . $id);
          
           if($cachedOffre){
           Redis::del('offre_' .$id);
           }*/
          // return $request->offre;
           Redis::set('offre_' . $id,$request->offre);
   