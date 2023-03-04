<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
       'name_img', 'format','url','secure_url','size','width','height','type_model','public_id','variants','imageable_id','imageable_type'
    ];
    protected $casts = [
        'variants' => 'array',
    ];
    public function imageable()
    {
        return $this->morphTo();
    }
}
