<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferencesPoste extends Model
{
    use HasFactory;

    //'lieu','zone','type','secteurs','student_id'

    protected $fillable = ['lieu','zone','type','secteurs','student_id'];

    public function student()
    {
    return $this->belongsTo(Student::class);
    }
}
