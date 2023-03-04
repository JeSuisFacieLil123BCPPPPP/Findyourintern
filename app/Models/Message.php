<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Message extends Model
{
    use HasFactory;
   // id,title,user_send_id,user_rec_id
    protected $fillable = [
        'user_send_id',
        'user_rec_id',
        'body',
        'read_at', 'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_send_id');
    }

   /* public function sendBy()
    {
        return $this->belongsTo(User::class,'id','user_send_id');
    }
    public function recBy(){
        return $this->belongsTo(User::class,'id','user_rec_id');
    }*/

}
