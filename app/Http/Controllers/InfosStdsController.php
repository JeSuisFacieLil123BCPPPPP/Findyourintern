<?php

namespace App\Http\Controllers;

use App\Models\InfosStds;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Resources\InfosStdsResource;
class InfosStdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return InfosStdsResource::collection(InfosStds::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $InfosStds = new InfosStds(array(
            'pays' => $request->pays,
            'ville' => $request->ville,
            'date_nais' => $request->date_nais,
            'decla_pers' => $request->decla_pers,
            'genre' => $request->genre,
            'student_id' => $request->studentId,
        ));
        
        $InfosStds->save();

        $response = response()->json([
            'message' => 'The infos has been created succesfully',
           'InfosStds'=> new      InfosStdsResource($InfosStds)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InfosStdss  $InfosStdss
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
        $InfosStds= InfosStds::find($id);
        if (!  $InfosStds) {

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
           'infos'  => new InfosStdsResource($InfosStds)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InfosStdss  $InfosStdss
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
       /* $student = Student::find($studentId);
         if (!$student) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  user cannot be found.'
                ]
            ], 404);
            return $response;
        }*/
        $InfosStds= InfosStds::find($id);
        if (! $InfosStds) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        $InfosStds->update($request->all());

        $response = response()->json([
            'message' => 'The infos has been updated succesfully',
           'infos'  => new InfosStdsResource($InfosStds),
        ], 201);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InfosStdss  $InfosStdss
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
       /* $student = Student::find($studentId);
        if (!$student) {

           $response = response()->json([
               'error' => [
                   'message' => 'This  user cannot be found.'
               ]
           ], 404);
           return $response;
       }*/
       $InfosStds= InfosStds::find($id);

       InfosStds::destroy($InfosStds->id);
       
       $response = response()->json([
       'message' => 'The indos has been deleted.'
       ], 200);
      
      return $response;
    }

    public function updateOrCreate(Request $request){
        // return $request->all();
         $infos=InfosStds::updateOrCreate(
             ['id' => $request->id || 0],
             $request->all(),
         );
        // $Langue->update($request->all());
 
         $response = response()->json([
             'message' => 'The infos has been updated succesfully',
            'InfosSupp'  => new  InfosStdsResource($infos),
         ], 201);
 
         return $response;
     }
}
