<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Models\User;
class StudentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
       // return parent::toArray($request); 'firstname','lastname','pays','entity_id','filiere_id',
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' =>  $this->lastname,
         
           // 'school_name' =>  $this->school_name,
            'preferencesPoste' =>  $this->preferencesPoste,
             'infosSupp'=>  $this->infos,
             'experiences'=>  $this->experiences,
             'formations'=>  $this->formations,
             'langues'=>  $this->langues,
          'competences'=>  $this->competences,
          'avatar'=>  $this->user->avatar,
          'email'=>  $this->user->email,
             'cv'=>  $this->cv,
             'user_id'=>  $this->user->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'entity'=>  $this->entity,
             'filiere'=>  $this->filiere,
        ];
    }
}
