<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RealisationsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //'title','description','nbr_vue','valide'
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' =>  $this->description,
            'nbr_vue' => $this->nbr_vue,//nbrdisLikes
            'nbrLikes' => $this->nbrLikes,
            'nbrdisLikes' => $this->nbrdisLikes,
            'valide' =>  $this->valide,
            'reaction'=>  $this->userRealReactions,
            'user'=>new UserResource($this->user),
            'poster'=> $this->poster,
            'images'=> $this->images,
            'video'=> $this->video,
            'documents'=> $this->documents,
            'tags'=> $this->tags,
            'entity'=> new EntityResource($this->user->entity),
            'nbrComments'=> count($this->comments),
            //'user'=>new UserResource(User::findOrFail($this->user->id)),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
