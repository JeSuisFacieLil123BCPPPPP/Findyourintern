<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use App\Models\Student;
use App\Http\Resources\CompetenceResource;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    public function index()
    {

        return CompetenceResource::collection(Competence::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Competence = new Competence(array(
            //'poste','company_name','date_deb','date_fin',''description'','student_id'
            'description' => $request->description,
            'student_id'=> $request->studentId
        ));
        
        $Competence->save();

        $response = response()->json([
            'message' => 'The infos has been created succesfully',
           'Competence'=> new      CompetenceResource($Competence)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Competences  $Competences
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
        $Competence= Competence::find($id);
        if (!  $Competence) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        //$response = new UserResource($user);
        return $response = response()->json([
            'message' => 'The competence has been found',
           'Competence'  => new CompetenceResource($Competence)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Competences  $Competences
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
        $Competence= Competence::find($id);
        if (! $Competence) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        $Competence->update($request->all());

        $response = response()->json([
            'message' => 'The infos has been updated succesfully',
           'infos'  => new CompetenceResource($Competence),
        ], 201);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Competences  $Competences
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
       $Competence= Competence::find($id);

       Competence::destroy($Competence->id);
       
       $response = response()->json([
       'message' => 'The indos has been deleted.'
       ], 200);
      
      return $response;
    }
}
