<?php

namespace App\Http\Controllers;

use App\Models\ReponsePostuler;
use App\Http\Resources\ReponsePostulerRessource;
use Illuminate\Http\Request;

class ReponsePostulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // return "fghj";
        //$category = Category::findOrFail($category_id);
        //$user = User::where('facebook_id', $data->id)->first();
        return ReponsePostulerRessource::collection(ReponsePostuler::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
       /* if ((!$request->name)) {
            $response = response()->json(['error' => ['message' => 'Champs requis']], 422);
            return $response;
        }*/

        $reponse= new ReponsePostuler(array(
            'user_id' => $request->userId,
            'postuler_id' => $request->postulerId,
            'reponse' => $request->reponse,
        ));
        
        $reponse->save();

        $response = response()->json([
            'message' => 'LA REPONSE A ETE ENVOYE AVEC SUCCES',
           'tag'=> new      ReponsePostulerRessource($reponse)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function show(ReponsePostuler $reponse)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReponsePostuler $reponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReponsePostuler $reponse)
    {
        //
    }
}
