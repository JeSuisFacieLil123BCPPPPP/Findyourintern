<?php

namespace App\Http\Controllers;

use App\Models\Salaire;
use Illuminate\Http\Request;
use App\Http\Resources\SalaireResource;

class SalaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*'montant' => $request->montant,
        'devise'=> $request->devise,
        'frequence' => $request->frequence,
        'salaireable_id'=> $user_id,
        'salaireable_type' => 'App\Models\Offre',*/
        $salaire = new Salaire(array(
            'montant' => $request->montant,
        'devise'=> $request->devise,
        'frequence' => $request->frequence,
        'salaireable_id'=>$request->studentId,
        'salaireable_type' => 'App\Models\Offre'
        ));
        
        $salaire->save();

        $response = response()->json([
            'message' => 'The infos has been created succesfully',
           'InfosStds'=> new      SalaireResource($salaire)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Salaire  $salaire
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $salaire= Salaire::find($id);
        if (!   $salaire) {

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
           'user'  => new SalaireResource( $salaire)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Salaire  $salaire
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $Salaire= Salaire::find($id);
        if (!  $Salaire) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        $Salaire->update($request->all());

        $response = response()->json([
            'message' => 'The infos has been updated succesfully',
           'infos'  => new SalaireResource( $Salaire),
        ], 201);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Salaire  $salaire
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $salaire= Salaire::find($id);

       Salaire::destroy($salaire->id);
        
        $response = response()->json([
        'message' => 'The salaire has been deleted.'
        ], 200);
       
       return $response;
    }
}
