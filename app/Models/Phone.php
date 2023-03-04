<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;
    protected $table='phones';
    
    protected $fillable = [
        'phone_number','indic_tel','phoneable_id','phoneable_type'
    ];
    /*protected $casts = [
        'phone_number' => 'int',
    ];*/
  /*  public function user()
 {
 return $this->belongsTo(User::class);
 }*/
 public function phoneable()
 {
     return $this->morphTo();
 }
}
