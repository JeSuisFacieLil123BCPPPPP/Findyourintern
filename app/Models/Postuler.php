<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Postuler extends Pivot
{
    use HasFactory;
    public $incrementing = true;

 protected $fillable = [
    'offre_id','user_id','message','cv','documents'
    ];
 //   return $this->belongsToMany(User::class,'postuler','offre_id','user_id')->withPivot('message','cv','realisation_id')->withTimestamps();

   // return $this->belongsToMany(User::class)->using(RoleUser::class);
    public function postulerRealisations()
    {
        return $this->belongsToMany(Realisations::class,'postuler_realisations','postuler_id','realisation_id')->withTimestamps();
    }

    public function reponsePostuler()
{
return $this->hasOne(ReponsePostuler::class,'postuler_id');

}

}
