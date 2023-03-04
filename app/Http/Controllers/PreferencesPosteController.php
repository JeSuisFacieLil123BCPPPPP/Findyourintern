<?php

namespace App\Http\Controllers;

use App\Models\PreferencesPoste;
use App\Models\Student;
use App\Http\Resources\PreferencesPosteResource;
use Illuminate\Http\Request;

class PreferencesPosteController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // 'lieu','zone','type','secteurs','student_id'
        $PreferencesPoste = new PreferencesPoste(array(
            'lieu' => $request->montant,
            'zone'=> $request->devise,
            'type' => $request->frequence,
            'secteurs'=>$request->secteurs,
            'student_id' =>$request->studentId
        ));
        
        $PreferencesPoste->save();

        $response = response()->json([
            'message' => 'The infos has been created succesfully',
           'prefs'=> new      PreferencesPosteResource($PreferencesPoste)
        ], 201);


        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PreferencesPoste  $PreferencesPoste
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
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
        $PreferencesPoste= PreferencesPoste::find($id);
        if (!   $PreferencesPoste) {

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
           'user'  => new PreferencesPosteResource( $PreferencesPoste)
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PreferencesPoste  $PreferencesPoste
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
        $PreferencesPoste= PreferencesPoste::find($id);
        if (!  $PreferencesPoste) {

            $response = response()->json([
                'error' => [
                    'message' => 'This  infos cannot be found.'
                ]
            ], 404);
            return $response;
        }
        $PreferencesPoste->update($request->all());

        $response = response()->json([
            'message' => 'The infos has been updated succesfully',
           'Preferences'  => new PreferencesPosteResource( $PreferencesPoste),
        ], 201);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PreferencesPoste  $PreferencesPoste
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,int $id)
    {
        /*$student = Student::find($studentId);
        if (!$student) {

           $response = response()->json([
               'error' => [
                   'message' => 'This  user cannot be found.'
               ]
           ], 404);
           return $response;
       }*/
        $PreferencesPoste= PreferencesPoste::find($id);

       PreferencesPoste::destroy($PreferencesPoste->id);
        
        $response = response()->json([
        'message' => 'The PreferencesPoste has been deleted.'
        ], 200);
       
       return $response;
    }
    public function updateOrCreate(Request $request){
        // return $request->all();
         $Langue=PreferencesPoste::updateOrCreate(
             ['id' => $request->id || 0],
             $request->all(),
         );
        // $Langue->update($request->all());
 
         $response = response()->json([
             'message' => 'The infos has been updated succesfully',
            'Preferences'  => new PreferencesPosteResource($Langue),
         ], 201);
 
         return $response;
     }
}
