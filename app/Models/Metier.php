<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Metier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
    ];
    public function user()
 {
 return $this->belongsTo(User::class);
 }

 public function portfolio()
    {
    return $this->hasMany(Portfolio::class,'metier_id');
    }
}
