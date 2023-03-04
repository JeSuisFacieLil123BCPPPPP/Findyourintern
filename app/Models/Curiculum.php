<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curiculum extends Model
{
    use HasFactory;
    protected $fillable = ['link','student_id','created_at','updated_at'];
    public function student()
    {
    return $this->belongsTo(Student::class);
    }
}
