<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    //Company(id,company_name,pays,description,user_id)
    protected $table='companies';
   
    protected $fillable = [
        'company_name','pays','description','ville','site','logo','adresse'
    ];
    public function user()
 {
 return $this->belongsTo(User::class);
 }
}
