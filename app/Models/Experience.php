<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    //'poste','company_name','date_deb','date_fin','description'
    protected $fillable = [
        'poste','company_name','date_deb','date_fin','description','student_id'
    ];
    protected $casts = [
        'date_fin' => 'date',
        'date_deb'=>'date'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }


}
