<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable = [
     'user_id','metier_id','poster','url'
        ];
    
        public function user()
 {
 return $this->belongsTo(User::class);
 }
 public function metier()
 {
 return $this->belongsTo(Metier::class);
 
 }
}
