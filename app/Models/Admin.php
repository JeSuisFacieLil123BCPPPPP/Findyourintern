<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Admin extends Model
{
    //Admin(id,firstname,lastname,pays,user_id)
    use HasFactory;
    protected $table='admins';
    
    protected $fillable = [
        'firstname','lastname','pays',
    ];
    public function user()
 {
 return $this->belongsTo(User::class);
 }
}
