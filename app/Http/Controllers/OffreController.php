<?php

namespace App\Http\Controllers;

use App\Http\Resources\OffreResource;
use App\Models\Offre;
use App\Models\User;
use App\Models\Realisations;
use App\Http\Resources\RealisationsResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\PostulerRessource;
use App\Models\Phone;
use App\Models\Postuler;
use App\Models\Salaire;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

class OffreController extends Controller
{
    public function allOffres()
    {
        //return  RealisationsResource::collection(Realisations::all());
        $realisation = Offre::all();
        return [
            'data' => OffreResource::collection(Offre::collection(Offre::all())),
            'total' => Offre::all()->count()
        ];
    }

    public function getAllOffresValide()
    {
        return [
            'data' => OffreResource::collection(Offre::all()),
            'total' => Offre::where('valide', '=', true)->count(),
        ];
        //return Realisations::where('valide', '=', true)->count();
    }
    public function getAllOffreNoValide()
    {
        return [
            'data' => OffreResource::collection(Offre::all()),
            'total' => Offre::where('valide', '=', false)->count()
        ];
    }
    public function getOffresForUser(Request $request, $userId)
    {
        return  OffreResource::collection(Offre::where('user_id', $userId)->orderBy( $request->sortField != null ? $request->sortField : 'id', $request->sortOrder != null ? $request->sortOrder : 'asc')->paginate($request->results ? $request->results :4));
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
        DB::beginTransaction();

        try {
        $offre = new Offre(array(
            'title' =>$request->title['value'],
            'type' => $request->type['value'],
            'secteur' =>$request->secteur['value'],
            'description' => $request->description['value'],
            'exigences' => $request->exigences['value'],
            'lieu' => $request->lieu['value'],
            'zone' =>  $request->lieu['value'] == 'Télétravail' ? null : $request->zone['value'],
            'date_limite' => $request->datef == true ? $request->date_limite['value'] :  null,
            'date_deb' => $request->dated == true ? $request->date_deb['value'] : null,
            'urgence' => $request->urgence['value'],
            'emails' =>$request->emails,
            'duree' =>$request->duree,
            'nbr' => $request->nbr['value'],
            'horaires' =>$request->horaires,
            'reject' => $request->isSwitched['value'] == true ? $request->reject['value'] : null,
            'autoriseMail' => $request->autoriseMail['value'] ? $request->autoriseMail['value'] : false,
            'auto_convers' =>$request->auto_convers['value'] ? $request->auto_convers['value'] : false,
            'niveau_std' =>$request->niveau_std,
            'niveau_exp' =>$request->niveau_exp['value'],
            'moyens' =>$request->moyens,
         'docs' =>$request->docs,
            'candidature' =>$request->candidature,
            'user_id' => $user_id,
        ));
        $sucess = $offre->save();
       
        if ($sucess && $request->telephone['phone_number'] &&  $request->telephone['indic_tel']) {

            $phone = new Phone(array(
                'phone_number' =>(int)$request->telephone['phone_number'],
                'indic_tel' =>$request->telephone['indic_tel'] || '+229',
                'phoneable_id' =>$offre->id,
                'phoneable_type' => 'App\Models\Offre',
            ));

            $phone->save();
        }
        if ($sucess && $request->salaire) {
            $salaire = new Salaire(array(
                'montant' => (int)$request->salaire['value']['montant'],
                'devise' =>$request->salaire['value']['devise'],
                'frequence' => $request->salaire['value']['frequence'],
                'salaireable_id' => $user_id,
                'salaireable_type' => 'App\Models\Offre',
            ));
            $salaire->save();
        }
        DB::commit();
        $response = response()->json([
            'message' => 'Offre enrégistrée avec succès',
            new OffreResource($offre)
        ], 201);

        return $response;
       
    } catch (QueryException $e) {
        // Annuler la transaction
        DB::rollBack();
        return response()->json($e, 500);
       //return $e;
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
        $offre = Offre::find($id);
        if (!$offre) {
            $response = response()->json([
                'error' => [
                    'message' => 'This  realisation cannot be found.'
                ]
            ], 404);
            return $response;
        }
        return  new OffreResource($offre);
    }
    public function getRealisationsByUser(Request $request, $userId)
    {
        $offres = Offre::where('user_id', '=', $userId)->get();
        if (!$offres) {
            $response = response()->json([
                'error' => [
                    'message' => 'This  offre cannot be found.'
                ]
            ], 404);
            return $response;
        }

        return $offres;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Realisations  $realisations
     * @return \Illuminate\Http\Response
     */
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Realisations  $realisations
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request,$id)
    {
        $offre = Offre::find($id);
        if (!$offre) {
            $response = response()->json([
                'error' => [
                    'message' => 'The offre cannot be found.'
                ]
            ], 404);

            return $response;
        }

        Offre::destroy($id);

        $response = response()->json([
            'message' => 'The offre has been deleted.'
        ], 200);

        return $response;
    }

    public function action(Request $request, $id)
    {
        $offre =Offre::find($id);
        if (!$offre){
            $response = response()->json(['error' => ['message' => 'Offre non trouvé']], 500);
            return $response;
        }
        $offre->update($request->all());
        $response = response()->json([
            'message' => 'Mis à jour avec succès',
            new OffreResource($offre)
        ], 201);

        return $response;
        
    }

   /* public function getOffresForUser(Request $request, $userId)
    {
        return OffreResource::collection(Offre::where('user_id', $userId)->paginate(7));
    }*/
    public function getPostulantsbyOffre(Request $request, $offreId)
    {
        return  PostulerRessource::collection(Postuler::where('offre_id', $offreId)->get());
    }

    public function getOffresPaginate(Request $request)
    {
        return  OffreResource::collection(Offre::where('status','=','activate')->paginate(4));
    }
    public function getOffresPostulerUser(Request $request, $userId)
    {
        $offresId = DB::table('postuler')
            ->where('user_id', $userId)
            ->pluck('offre_id');
        $offres = Offre::whereIn('id', $offresId)->paginate(12);

        return  OffreResource::collection($offres);
    }

    public function postuler(Request $request)
    {
        $offre = Offre::find($request->offreId);
        $user = User::find($request->userId);
        $postuler = new Postuler(array(
            'user_id' => $request->userId,
            'offre_id' => $request->offreId,
            'message' => $request->message || null,
            'cv' => $request->cv || null,
            'documents'  => $request->documents || null,
        ));
        $postuler->save();

        if (count($request->projets) != 0) {
            foreach ($request->projets as $projet) {
                $postuler->postulerRealisations()->attach($projet);
            }
        }
        $response = response()->json([
            'message' => 'Vous venez de postuler à une offre avec succès',
            $offre
        ], 201);
        return $response;
    }



    public function getAllOffresSearch(Request $request)
    {

       // return $request;
        $offres = Offre::where('status', '=','activate');
        // strlen($request->search);
        if (strlen($request->title) != 0) {
            $offres = $offres->where('title', 'LIKE', '%' . $request->title . '%');
        } else {
            $offres =  $offres->where('id', '!=', null);
        }
        if ($request->type)
            $offres = $offres->where('type', $request->type);
        if ($request->secteur)
            $offres = $offres->where('secteur', $request->secteur);
            if ($request->lieu)
            $offres = $offres->where('lieu', $request->lieu);
            if ($request->zone)
            $offres = $offres->where('zone', 'LIKE', '%' . $request->zone . '%');
       /* if ($request->fonction)
            $offres = $offres->where('fonction', $request->fonction);
        if ($request->disponibilite)
            $offres = $offres->where('disponibilite', $request->disponibilite);*/

        // return OffreResource::collection(Offre::where('title', 'LIKE', '%'.$request->search.'%')->where('type',$request->type)->paginate(3));

        return OffreResource::collection($offres->paginate(3));
    }
}
