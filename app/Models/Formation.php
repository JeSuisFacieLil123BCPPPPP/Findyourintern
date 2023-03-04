<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;
    //'poste','institution','date_deb','date_fin','theme','type','status','student_id'

    protected $fillable = [
      'institution','date_deb','date_fin','theme','type','status','diplome','student_id'
    ];
    protected $casts = [
        'date_fin' => 'date',
        'date_deb'=>'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class,);
    }

}
