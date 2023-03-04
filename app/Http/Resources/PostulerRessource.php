<?php

namespace App\Http\Resources;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PostulerRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            //'offre_id' => $this->offre_id,
            'message' => $this->message,
            'user' => new UserResource(User::find($this->user_id)),
            'offre' => User::find($this->offre_id),
            'cv'=> $this->cv,
            'realisations'=> $this->postulerRealisations,
            'reponse'=> $this->reponsePostuler,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
