<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offre extends Model
{
    use HasFactory;
    //user_id,title,description,metier,experience,localisation

    //       //titre,type,secteur,fonction,responsabilité,exigences, zone,disponiblité,date_limite,
    protected $fillable = [
        'title','user_id','type','secteur','description','exigences','zone','date_limite','nbr','lieu','date_deb','duree',/*'salaire',*/'horaires','urgence','emails','reject','autoriseMail','auto_convers','niveau_std','niveau_exp','moyens','candidature','docs',  'status',
        'competences'/*'telephone','telephoneNum',*/
    ];
    protected $casts = [
        'date_limite' => 'date',
        'date_deb'=>'date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function phone()
{
    return $this->morphOne(Phone::class, 'phoneable');
//return $this->hasOne(Phone::class,/*'user_id'*/);

}
public function salaire()
{
    return $this->morphOne(Salaire::class, 'salaireable');
//return $this->hasOne(Phone::class,/*'user_id'*/);

}
    public function postuler()
    {
        return $this->belongsToMany(User::class,'postuler','offre_id','user_id')->using(Postuler::class);
        //return $this->belongsToMany(User::class,'postuler','offre_id','user_id')->withPivot('message','cv','realisation_id')->withTimestamps();
    }
}
