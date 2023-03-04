<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReponsePostuler extends Model
{
    use HasFactory;
    protected $fillable = [
        'postuler_id','user_id','reponse',
        ];
    
        public function user()
 {
 return $this->belongsTo(User::class,'user_id');
 }

 public function postuler()
 {
 return $this->belongsTo(Postuler::class);
 }
}
