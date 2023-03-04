<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Filiere extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','entity_id'
    ];
    public function entity()
    {
        return $this->belongsTo(Entity::class,);
    }
    public function realisations()
    {
        return $this->hasMany(Realisations::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

}
