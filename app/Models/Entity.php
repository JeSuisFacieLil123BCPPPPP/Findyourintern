<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    use HasFactory;
    protected $fillable = [
        'name', 'logo',
    ];
    public function filieres()
    {
        return $this->hasMany(Filiere::class);
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
