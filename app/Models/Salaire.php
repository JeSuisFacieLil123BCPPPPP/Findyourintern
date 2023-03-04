<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salaire extends Model
{
    use HasFactory;

    protected $table='salaires';
    
    protected $fillable = [
        'montant','devise','frequence','salaireable_id','salaireable_type'
    ];
    //'montant','devise','frequence','salaireable_id','salaireable_type'
    public function salaireable()
    {
        return $this->morphTo();
    }

}
