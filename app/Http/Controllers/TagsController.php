<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\TagRessource;

class TagsController extends Controller
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
        return TagRessource::collection(Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       /* if ((!$request->name)) {
            $response = response()->json(['error' => ['message' => 'Champs requis']], 422);
            return $response;
        }*/

        $tag = new Tag(array(
            'name' => $request->name,
        ));
        
        $tag->save();

        $response = response()->json([
            'message' => 'The category has been created succesfully',
           'tag'=> new      TagRessource($tag)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tags)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tags)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tags  $tags
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tags)
    {
        //
    }
}
