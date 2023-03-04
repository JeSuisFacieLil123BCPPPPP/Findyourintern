<?php

namespace App\Http\Controllers;

use App\Models\Curiculum;
use Illuminate\Http\Request;
use App\Http\Resources\CuriculumResource;
class CuriculumController extends Controller
{ public function index()
    {

        return CuriculumResource::collection(Curiculum::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Curiculum = new Curiculum(array(
            //'poste','company_name','date_deb','date_fin',''description'','student_id'
            'link' => $request->link,
          
        ));
        
        $Curiculum->save();

        $response = response()->json([
            'message' => 'The Curiculum has been created succesfully',
           'Curiculum'=> new      CuriculumResource($Curiculum)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Curiculums  $Curiculums
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
        $Curiculum= Curiculum::find($id);
        if (!  $Curiculum) {

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
           'infos'  => new CuriculumResource($Curiculum)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Curiculums  $Curiculums
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
        $Curiculum= Curiculum::find($id);
        if (! $Curiculum) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        $Curiculum->update($request->all());

        $response = response()->json([
            'message' => 'The infos has been updated succesfully',
           'infos'  => new CuriculumResource($Curiculum),
        ], 201);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Curiculums  $Curiculums
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
       $Curiculum= Curiculum::find($id);

       Curiculum::destroy($Curiculum->id);
       
       $response = response()->json([
       'message' => 'The indos has been deleted.'
       ], 200);
      
      return $response;
    }
}
