<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\PhoneResource;

class OffreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        // 'title','user_id','type','secteur','fonction','responsabilite','exigences','zone','disponibilite','date_limite',
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' =>  $this->type,
            'secteur' =>  $this->secteur,
           // 'fonction' => $this->fonction,//nbrdisLikes
            'description' => $this->description,
            'exigences' => $this->exigences,
            'zone' => $this->zone,
          //  'disponibilite' => $this->disponibilite,
            'date_limite' => $this->date_limite, 
            'nbr'=> $this->nbr,//'autoriseMail','auto_convers','telephone','telephoneNum'
            'lieu' => $this->lieu, 
            'duree' => $this->duree, 
            'salaire' => $this->salaire, 
            'horaires' => $this->horaires, 
            'urgence' => $this->urgence, 
            'emails' => $this->emails, 
            'reject' => $this->reject,
            'autoriseMail' => $this->autoriseMail, 
            'auto_convers' => $this->auto_convers, 
            'telephone' =>  new PhoneResource($this->phone),
            'niveau_std' =>$this->niveau_std,
            'niveau_exp' =>$this->niveau_exp,
            'moyens' =>$this->moyens,
            'candidature' =>$this->candidature,
            'docs' =>$this->docs,
            'status' =>$this->status,
            'competences' =>$this->competences,
           // 'telephoneNum' =>  $this->telephoneNum ?  $this->telephoneNum : null,
           //'niveau_std','niveau_exp','moyens','candidature','docs'
            'date_deb' =>$this->date_deb,     
            'user'=>new UserResource($this->user),
            'postuler' => $this->postuler, 
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
