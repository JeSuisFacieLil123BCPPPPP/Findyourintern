<?php

namespace App\Http\Controllers\Cache;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Offre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;

class CVBuilderController extends Controller
{
    public function getStudentCvBuilder(Request $request,$id){
        $infosCache= Redis::get('detailsStudent_' . $id); 
        $infos= json_decode($infosCache, FALSE);     
        return [
            'details' => $infos,
            'message' => "Succès de l'operation"
        ];
    }
    public function getExperiencesCvBuilder(Request $request,$id){
        $experiences = Redis::lrange('experiences_' . $id, 0, -1);
        if ($experiences) {
            $experiences = $experiences;
        } else {
            $experiencesBD = Experience::where('student_id', $id)->get();
            foreach ($experiencesBD as $exp) {
                Redis::lpush('experiences_' . $id, json_encode($exp));
            }
            $experiences = Redis::lrange('experiences_' . $id, 0, -1);
            //$experiences = $experiencesBD;
        }
        return [
            'experiences' => $experiences,
            'message' => "Succès de l'operation"
        ];
    }
    //https://www.reed.co.uk/api/cvbuilder/addworkexperience
    public function addorUpdateDetailsStudent(Request $request)
    {
        $infosCache= Redis::get('detailsStudent_' . $request->id);
         
        if($infosCache){
        Redis::del('detailsStudent_' .$request->id);
        }
      
        Redis::set('detailsStudent_' . $request->id, json_encode($request->infos));
        //return $request->infos;
        $infosCache= Redis::get('detailsStudent_' . $request->id);
   
        return [
            'info' => json_decode($infosCache),
            'message' => "Succès de l'operation"
        ];
    }
    public function AupdateWorkExperience(Request $request)
    {
        $experiences = Redis::lrange('experiences_' . $request->id, 0, -1);
       
        //array_push($experiences, $request->experience);
       // return $experiences;
        if (isset($experiences[$request->index])) {
            // Trouver l'objet à partir de son index
            $experiences[$request->index] = $request->esperience;
        } else {

            return [
                'message' => "Pas trouvé"
            ];
        }
        Redis::set('experiences_' . $request->id, serialize($experiences));
        $serializedExperiences = Redis::get('experiences_' . $request->id);
        return [
            'experience' => $request->experience,
            'experiences' => unserialize($serializedExperiences),
            'message' => "Succès de l'operation"
        ];
    }
    public function addWorkExperience(Request $request)
    {
        $experiences = Redis::lrange('experiences_' . $request->id, 0, -1);
       
        array_push($experiences, $request->experience);
        Redis::del('experiences_' . $request->id);
    foreach ($experiences as $exp) {
        Redis::lpush('experiences_' . $request->id, json_encode($exp));
    }
    $serializedExperiences = Redis::lrange('experiences_' . $request->id, 0, -1);
    return [
        'experience' => $request->experience,
        'experiences' => $serializedExperiences,
        'message' => "Succès de l'operation"
    ];
    }
    public function updateWorkExperience(Request $request)
{
    $experiences = Redis::lrange('experiences_' . $request->id, 0, -1);
    if (isset($experiences[$request->index])) {
        // Trouver l'objet à partir de son index
        $experiences[$request->index] = $request->experience;
    } else {

        return [
            'message' => "Pas trouvé"
        ];
    }
    Redis::set('experiences_' . $request->id, serialize($experiences));
    $serializedExperiences = Redis::get('experiences_' . $request->id);
    return [
        'experience' => $request->experience,
        'experiences' => unserialize($serializedExperiences),
        'message' => "Succès de l'operation"
    ];
}
   /* public function updateWorkExperience(Request $request)
    {
        $experiences = Redis::lrange('experiences_' . $request->id, 0, -1);
        if (isset($experiences[$request->index])) {
            // Trouver l'objet à partir de son index
            $experiences[$request->index] = $request->esperience;
        } else {

            return [
                'message' => "Pas trouvé"
            ];
        }
        Redis::set('experiences_' . $request->id, serialize($experiences));
        $serializedExperiences = Redis::get('experiences_' . $request->id);
        return [
            'experience' => $request->experience,
            'experiences' => unserialize($serializedExperiences),
            'message' => "Succès de l'operation"
        ];
    }*/

    //tu passe l'index
    /*public function deleteWorkExperience(Request $request)
    {

        $id=json_decode($request->id);
        $experiences = Redis::lrange('experiences_' .$id, 0, -1);

        //return $request;
        if (isset($experiences[$request->index])) {
           // Redis::del('experiences_' .$id, 0, -1);
            // Trouver l'objet à partir de son index
            $experience = $experiences[$request->index];
            //return $experience;
            array_splice($experiences, $request->index, 1);
        } else {

            return [
                'message' => "Pas trouvé"
            ];
        }
        Redis::set('experiences_' . $request->id, serialize($experiences));
        $serializedExperiences = Redis::get('experiences_' . $request->id);
        return [
            'index' => $request->index,
            'experiences' => unserialize($serializedExperiences),
            'message' => "Succès de l'operation"
        ];
    }*/
    public function deleteWorkExperience(Request $request)
    {
        $id = json_decode($request->id);
        $experiences = Redis::lrange('experiences_' . $id, 0, -1);
    
        if (isset($experiences[$request->index])) {
            // Trouver l'objet à partir de son index
            $experience = $experiences[$request->index];
            // Supprimer l'objet de la liste
            Redis::lrem('experiences_' . $id, 1, json_encode($experience));
            // Mettre à jour la liste dans Redis
            $experiences = Redis::lrange('experiences_' . $id, 0, -1);
        } else {
            return [
                'message' => "Pas trouvé"
            ];
        }
        return [
            'index' => $request->index,
            'experiences' => $experiences,
            'message' => "Succès de l'operation"
        ];
    }
    
    
    public function addWorkFormation(Request $request)
    {
        $id = Auth::user();

        $cachedFormations = Redis::get('formations_' . $id);
        if (!$cachedFormations) {
            $cachedFormations = [];
        }
        $formations = json_decode($cachedFormations, true);
        array_push($formations, $request->formation);
        Redis::del('formations_' . $id);
        Redis::set('formations_' . $id, $formations);

        return [
            'formation' => $request->formation,
            'formations' => $formations,
            'message' => "Succès de l'operation"
        ];
    }
}
