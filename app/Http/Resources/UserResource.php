<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\StudentResource;
use App\Http\Resources\AdminResource;
use App\Http\Resources\CompanyResource;
use App\Models\Image;

class UserResource extends JsonResource
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
      'id' => $this->id,
      'pseudo' => $this->pseudo,
      'email' => $this->email,
      'email_verified_at' => $this->email_verified_at,
      'password' => $this->password, // password 123456789
      'remember_token' => $this->remember_token,
      'phone' => $this->phone, //UserResource(User::findOrFail($id)),
      'avatar' => $this->avatar,    
      'portfolio' => $this->portfolio,
      'user' => $this->when($this->user_type != 'normal', function () {
        switch ($this->user_type) {
          case 'student':
            return new StudentResource($this->student);
            break;
          case 'company':
            return new CompanyResource($this->company);
            break;
          case 'admin':
            return new AdminResource($this->admin);
            break;
        }
      }),
      'user_type' => $this->user_type,
      'is_locked' => $this->is_locked,
      'is_online' => $this->isOnline(),
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
