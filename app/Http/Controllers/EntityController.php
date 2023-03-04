<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use Illuminate\Http\Request;

use App\Http\Resources\EntityResource;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  EntityResource::collection(Entity::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //'name_cat', 'description','active',
        if ((!$request->name)) {
            $response = response()->json(['error' => ['message' => 'Please enter all required fields']], 422);
            return $response;
        }

        $entity  = new Entity(array(
            'name' => $request->name,
            'logo' => $request->logo,
        ));
        

        $entity ->save();

        $response = response()->json([
            'message' => 'The category has been created succesfully',
            new EntityResource($entity )
        ], 201);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entity  = Entity::find($id);
        if(!$entity ){
             $response = response()->json([
             'error' => [
             'message' => 'This  category cannot be found.'
             ]
             ], 404);
             return $response;
             }
            
             $response = new EntityResource($entity );
            return $response; 

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ((!$request->name)) {
            $response = response()->json(['error' => ['message' => 'Please enter all required fields']], 422);
            return $response;
        }

        $entity  = Entity::find($id);
        $entity->update($request->all());
        /*$category->description = $request->description;
        $category->active =$request->active;
        $category->save();*/
        $response = response()->json([
            'message' => 'The category has been updated succesfully',
            new EntityResource($entity )
        ], 201);

        return $response;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $entity  = Entity::find($id);
        if(!$entity ) {
        $response = response()->json([
        'error' => [
        'message' => 'The  category can not be found.'
        ]
        ], 404);
       
        return $response;
        }
       
        Entity::destroy($entity->id);
       
        $response = response()->json([
        'message' => 'The category has been deleted.'
        ], 200);
       
       return $response;
    }
}
