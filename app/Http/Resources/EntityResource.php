<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\FiliereResource;
use App\Models\Entity;
class EntityResource extends JsonResource
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
            'name'=> $this->name, 
            'logo'=> $this->logo, 
            'filieres'=> FiliereResource::collection($this->filieres),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
