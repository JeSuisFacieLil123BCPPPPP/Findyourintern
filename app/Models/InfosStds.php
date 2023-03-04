<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InfosStds extends Model
{
    use HasFactory;

    protected $fillable = ['pays','ville','date_nais','decla_pers','genre','student_id'];

    public function student()
    {
    return $this->belongsTo(Student::class);
    }
}
