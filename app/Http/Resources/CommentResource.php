<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Models\User;
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {//'body','user_id','realisation_id','comment_id'
        return [
            'id' => $this->id,
            'body'=> $this->body, 
            'comments'=> CommentResource::collection($this->comments),
            'realisationId'=>$this->realisation->id,
            'commentId'=>$this->comment_id,
            'user'=> new UserResource(User::findOrFail($this->user_id)),
            'userTo'=> new UserResource(User::find($this->comment_user)),
            'reaction'=>  $this->userCommentReactions,
            'nbrLikes' => (int)$this->nbrLikes,
            'nbrdisLikes' => (int)$this->nbrdisLikes,
            'nbrCommentsTo'=>  count($this->comments),
            'datetime' => $this->created_at,
            'datetimeLast' => $this->updated_at,
        ];
    }
}
