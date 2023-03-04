<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Realisations;
use App\Models\User;
class Comments extends Model
{
    use HasFactory;
    protected $fillable = [
        'body','user_id','realisation_id','comment_id','nbrLikes','nbrdisLikes','comment_user'
    ];
   
    public function realisation()
     {
         return $this->belongsTo(Realisations::class);
     }
     public function user()
     {
         return $this->belongsTo(User::class,'user_id','id');
     }
     public function comments()
     {
         return $this->hasMany(Comments::class,'comment_id','id');
     }
     
     public function comment()
     {
     return $this->belongTo(Comments::class,'id','comment_id');
     }

     public function userTo()
     {
         return $this->belongsTo(User::class,'comment_user','id');
     }
     public function userCommentReactions()
     {
         return $this->belongsToMany(User::class,'reactionsComment','comment_id','user_id')->withPivot('like', 'dislike')->withTimestamps();
     }

}
