<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    use HasFactory;
    // // 'name_langue','niveau','student_id'  // 'description','student_id' // 'link','student_id'
    protected $fillable = [
        'description','student_id'
    ];
   public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
