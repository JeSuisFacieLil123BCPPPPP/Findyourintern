<?php

namespace App\Http\Resources;

use App\Models\Phone;
use Illuminate\Http\Resources\Json\JsonResource;

class PhoneResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
         return  [
           // 'phone'=> new PhoneResource(Phone::findOrFail($this->phone->id)),
            'id' => $this->id,
            'phone_number'=> $this->phone_number,//UserResource(User::findOrFail($id)),
            'indic_tel'=> $this->indic_tel,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
