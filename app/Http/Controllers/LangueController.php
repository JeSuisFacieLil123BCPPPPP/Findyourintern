<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Http\Resources\LangueResource;
use App\Models\Langue;
use Illuminate\Http\Request;

class LangueController extends Controller
{
    public function index()
    {

        return LangueResource::collection(Langue::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $Langue = new Langue(array(
            //'poste','company_name','date_deb','date_fin',''description'','student_id'
            'name_langue' => $request->name_langue,
            'niveau' => $request->niveau,
            'student_id' => $request->studentId,
        ));
        
        $Langue->save();

        $response = response()->json([
            'message' => 'The infos has been created succesfully',
           'Langue'=> new      LangueResource($Langue)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Langues  $Langues
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
        $Langue= Langue::find($id);
        if (!  $Langue) {

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
           'infos'  => new LangueResource($Langue)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Langues  $Langues
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
        $Langue= Langue::find($id);
        if (! $Langue) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        $Langue->update($request->all());

        $response = response()->json([
            'message' => 'The infos has been updated succesfully',
           'infos'  => new LangueResource($Langue),
        ], 201);

        return $response;
    }
    public function updateOrCreate(Request $request){
       // return $request->all();
        $Langue=Langue::updateOrCreate(
            ['id' => $request->id || 0],
            $request->all(),
        );
       // $Langue->update($request->all());

        $response = response()->json([
            'message' => 'The infos has been updated succesfully',
           'Langue'  => new LangueResource($Langue),
        ], 201);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Langues  $Langues
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
       $Langue= Langue::find($id);

       Langue::destroy($Langue->id);
       
       $response = response()->json([
       'message' => 'The indos has been deleted.'
       ], 200);
      
      return $response;
    }
}
