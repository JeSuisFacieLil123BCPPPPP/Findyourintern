<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Resources\PortfolioResource;
use App\Models\Portfolio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
class PortfolioController extends Controller
{
    public function allOffres()
    {
        //return  RealisationsResource::collection(Realisations::all());
        $realisation =Portfolio::all();
        return [
            'data' =>PortfolioResource::collection(Portfolio::paginate(7)),
            'total' => Portfolio::all()->count()
        ];
    }

    public function getAllOffresValide()
    {
        return [
            'data' =>PortfolioResource::collection(Portfolio::all()),
            'total' => Portfolio::where('valide', '=', true)->count(),
        ];
        //return Realisations::where('valide', '=', true)->count();
    }
    public function getAllPortfolios(Request $request)
    {
        //return $request;
        if(strlen($request->metier)!=0){
            $metier=$request->metier;
            $portfolios =Portfolio::whereHas('metier', function (Builder $query)  use($metier){
                $query->where('name', '=',$metier);
            });
        
           // $portfolios=Portfolio::where('metier',$request->metier);
          }else{
          $portfolios=Portfolio::where('id','!=',null);
          }         
            return PortfolioResource::collection($portfolios->paginate(6));
        
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
        //'title','user_id','type','secteur','fonction','responsabilite','exigences','zone','disponiblite','date_limite',
        $offre = new Portfolio(array(
            'metier_id' => $request->metierId,
            'poster' => $request->poster,
            'url'=> $request->url,
            'user_id'=> $user_id,
        ));
       // return json_decode($request->tags);
        $offre->save();
        $response = response()->json([
            'message' => 'Portfolio ajouté avec succès',
           new PortfolioResource( $offre)
        ], 201);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Realisations  $realisations
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $portfolio= Portfolio::find($id);
        if (!$portfolio) {
            $response = response()->json([
                'error' => [
                    'message' => 'This  realisation cannot be found.'
                ]
            ], 404);
            return $response;
        }
//return $request;
       
        // $request->visitor()->visit($realisation);
        return  new PortfolioResource($portfolio);
    }

    public function getPortfoliobyUserId(Request $request, $userId)
    {
       // return $request;
        // RealisationsResource::collection(Realisations::where('user_id','=',$userId)->get()),
        $offre= Portfolio::where('user_id', '=', $userId)->get();
      
        if (!$offre) {
            $response = response()->json([
                'error' => [
                    'message' => 'This  realisation cannot be found.'
                ]
            ], 404);
            return $response;
        }

        return  PortfolioResource::collection($offre);
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
    public function delete($id)
    {
        $offre = Portfolio::find($id);
        if (!$offre) {
            $response = response()->json([
                'error' => [
                    'message' => 'The realisation cannot be found.'
                ]
            ], 404);

            return $response;
        }

        Portfolio::destroy($id);

        $response = response()->json([
            'message' => 'The realisation has been deleted.'
        ], 200);

        return $response;
    }

    public function getPortfolioForUser(Request $request, $userId)
    {
    return PortfolioResource::collection(Portfolio::where('user_id',$userId)->paginate(7));

    }
    public function getPostulantsbyOffre(Request $request, $offreId)
    {  
          return  PortfolioResource::collection(Portfolio::where('offre_id',$offreId)->get());
    }
}
