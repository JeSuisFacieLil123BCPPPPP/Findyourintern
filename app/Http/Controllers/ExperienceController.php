<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\Student;
use App\Http\Resources\ExperienceResource;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {

        return ExperienceResource::collection(Experience::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

       // return $request;
        $Experience = new Experience(array(
            //'poste','company_name','date_deb','date_fin',''description'','student_id'
            'poste' => $request->poste,
            'company_name' => $request->company_name,
            'date_deb'=> $request->date_deb,
            'date_fin' => $request->date_fin,
            'description' => $request->description,
            'student_id' => $request->studentId,
        ));
        
        $Experience->save();

        $response = response()->json([
            'message' => 'The infos has been created succesfully',
           'Experience'=> new      ExperienceResource($Experience)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Experiences  $Experiences
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
        $Experience= Experience::find($id);
        if (!  $Experience) {

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
           'Experience'  => new ExperienceResource($Experience)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Experiences  $Experiences
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $Experience= Experience::find($id);
        if (! $Experience) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        $Experience->update($request->all());

        $response = response()->json([
            'message' => 'The infos has been updated succesfully',
           'Experience'  => new ExperienceResource($Experience),
        ], 201);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Experiences  $Experiences
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
       $Experience= Experience::find($id);

       Experience::destroy($Experience->id);
       
       $response = response()->json([
       'message' => 'The indos has been deleted.'
       ], 200);
      
      return $response;
    }
}
