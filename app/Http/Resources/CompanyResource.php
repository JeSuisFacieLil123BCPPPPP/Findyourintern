<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Models\User;
class CompanyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return parent::toArray($request);
        /*return [
            'id' => $this->id,
            'company_name' => $this->company_name,
            'pays' => $this->pays,
            'description' => $this->description,
           // 'user'=>new UserResource(User::findOrFail($this->user->id)),
            'user_type'=> $this->user->user_type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];*/
    }
}
