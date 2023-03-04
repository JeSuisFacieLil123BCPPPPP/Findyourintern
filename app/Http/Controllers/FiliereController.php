<?php

namespace App\Http\Controllers;

use App\Models\Filiere;
use App\Models\Entity;
use Illuminate\Http\Request;

use App\Http\Resources\FiliereResource;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$entity_id)
    {
        $entity = Entity::findOrFail($entity_id);
        //$user = User::where('facebook_id', $data->id)->first();
        $filieres=Filiere::where('category_id',$entity_id)->get();
        return FiliereResource::collection($filieres);
    }

    //allsubcategories
    public function allsubcategories()
    {
        return  FiliereResource::collection(Filiere::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$entity_id)
    {
        //'name_subcat', 'description','active',
        $entity  = Entity::findOrFail($entity_id);
        if ((!$request->name)) {
            $response = response()->json(['error' => ['message' => 'Please enter all required fields']], 422);
            return $response;
        }

        $filiere = new Filiere(array(
            'name' => $request->name,
           // 'description' => $request->description,
           // 'active' => ($request->active)!=null ? $request->active:true ,
        ));
        $entity->filieres()->save($filiere);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $filiere = Filiere::find($id);
        if(!$filiere){
             $response = response()->json([
             'error' => [
             'message' => 'This  subcategory cannot be found.'
             ]
             ], 404);
             return $response;
             }
            
             $response = new FiliereResource($filiere);
            return $response; 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        if ((!$request->name)) {
            $response = response()->json(['error' => ['message' => 'Please enter all required fields']], 422);
            return $response;
        }

        $filiere = Filiere::find($id);
        $filiere->update($request->all());
        /*$subcategory->name_subcat = $request->name_subcat;
        $subcategory->description = $request->description;
        $subcategory->active =$request->active;
        $subcategory->save();*/
        $response = response()->json([
            'message' => 'The filiere has been updated succesfully',
            new FiliereResource($filiere)
        ], 201);

        return $response;
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subcategory  $subcategory
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        $filiere = Filiere::find($id);
        if(!$filiere) {
        $response = response()->json([
        'error' => [
        'message' => 'The post cannot be found.'
        ]
        ], 404);
       
        return $response;
        }
       
        Filiere::destroy($filiere->id);
       
        $response = response()->json([
        'message' => 'The post has been deleted.'
        ], 200);
       
       return $response;
    }
}
