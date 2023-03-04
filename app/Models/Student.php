<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*use App\Models\InfosStds;
use App\Models\PreferencesPoste;
use App\Models\Experience;
use App\Models\Formation;
use App\Models\Competence;
use App\Models\Langue;*/
class Student extends Model
{
    use HasFactory;
     //Student(id,firstname,lastname,pays,school_name,user_id)
     protected $table='students';
    
    protected $fillable = [
        'firstname','lastname','pays','entity_id','filiere_id',
    ];
    public function user()
 {
 return $this->belongsTo(User::class);
 }
 public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }
    public function infos()
{
return $this->hasOne(InfosStds::class,/*'user_id'*/);
}
public function preferencesPoste()
{
return $this->hasOne(PreferencesPoste::class,/*'user_id'*/);
}

public function experiences()
{
    return $this->hasMany(Experience::class);
}

public function formations()
{
    return $this->hasMany(Formation::class);
}

public function langues()
{
    return $this->hasMany(Langue::class);
}
public function competences()
{
    return $this->hasMany(Competence::class);
}

public function cv()
{
    return $this->hasOne(Curiculum::class);
}


}
