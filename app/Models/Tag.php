<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models\Realisations;

class Tag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 
    ];
    public function realisations()
    {
        return $this->belongsToMany(Realisations::class, 'realisationTags','tag_id','realisation_id')->withTimestamps();;
    }
}
