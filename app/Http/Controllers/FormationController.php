<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\FormationResource;

class FormationController extends Controller
{
    public function index()
    {

        return FormationResource::collection(Formation::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//'institution','date_deb','date_fin','theme','type','status','student_id'
        $Formation = new Formation(array(
            //'poste','company_name','date_deb','date_fin',''description'','student_id'
            'institution' => $request->institution,
              'diplome'=> $request->diplome,
            'date_deb'=> $request->date_deb,
            'date_fin' => $request->date_fin,
            'theme' => $request->theme,
            'type' => $request->type,
            'status' => $request->status,
            'student_id' => $request->studentId,
        ));
        
        $Formation->save();

        $response = response()->json([
            'message' => 'The infos has been created succesfully',
           'Formation'=> new      FormationResource($Formation)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Formations  $Formations
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
      /*  $student=  Student::find($studentId);
        if (!$student) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  user cannot be found.'
                ]
            ], 404);
            return $response;
        }*/
        $Formation= Formation::find($id);
        if (!  $Formation) {

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
           'infos'  => new FormationResource($Formation)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Formations  $Formations
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
        $Formation= Formation::find($id);
        if (! $Formation) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        $Formation->update($request->all());

        $response = response()->json([
            'message' => 'The infos has been updated succesfully',
           'infos'  => new FormationResource($Formation),
        ], 201);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Formations  $Formations
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $studentId)
    {
        $student = Student::find($studentId);
        if (!$student) {

           $response = response()->json([
               'error' => [
                   'message' => 'This  user cannot be found.'
               ]
           ], 404);
           return $response;
       }
       $Formation= Formation::find($student->infos->id);

       Formation::destroy($Formation->id);
       
       $response = response()->json([
       'message' => 'The indos has been deleted.'
       ], 200);
      
      return $response;
    }
}
