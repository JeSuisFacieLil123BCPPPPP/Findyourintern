<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
/*use App\Models\Admin;
use App\Models\Company;
use App\Models\Student;
use App\Models\Phone;
use App\Models\Image;
use App\Models\Message;
use App\Models\Comments;
use App\Models\Realisations;*/
use Shetabit\Visitor\Traits\Visitor;
//use Shetabit\Visitor\Traits\Visitable;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable
{
    //use Visitor;
    use HasApiTokens, HasFactory, Notifiable, Visitor;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //Users(id,pseudo,email,password,is_locked,user_type,)
    
    //protected $with = ['avatar'];
    protected $fillable = [
        'pseudo',
        'email',
        'password',
        'is_locked',
        'user_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
 public function admin()
{
return $this->hasOne(Admin::class,/*'user_id'*/);
}

public function company()
{
return $this->hasOne(Company::class,/*'user_id'*/);

}
public function student()
{
return $this->hasOne(Student::class,/*'user_id'*/);

}


public function phone()
{
    return $this->morphOne(Phone::class, 'phoneable');
//return $this->hasOne(Phone::class,/*'user_id'*/);

}
public function avatar()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type_model', 'avatar');
    }
    public function stockeImages()
    {
        return $this->morphMany(Image::class, 'stokeImageable')->where('type_model', 'stockeImages');
    }
    public function stockeFiles()
    {
        return $this->morphMany(File::class, 'stokefileable')->where('type_model', 'stockeFiles');
    }

    public function comments()
    {
        return $this->hasMany(Comments::class,'user_id','id');
    }
    public function commentTo()
    {
        return $this->hasMany(Comments::class,'comment_user','id');
    }
    public function realisations()
    {
        return $this->hasMany(Realisations::class);
    }
    public function realisationReactions()
    {
        return $this->belongsToMany(Realisations::class,'reactionsRealisation','user_id','realisation_id')->withPivot('like', 'dislike')->withTimestamps();
    }
    public function commentReactions()
    {
        return $this->belongsToMany(Comments::class,'reactionsComment','user_id','comment_id')->withPivot('like', 'dislike')->withTimestamps();
    }

    public function messagesSend()
    {
        return $this->hasMany(Message::class,'user_send_id','id');//->withPivot('body')->withTimestamps();
    }
    public function messagesRec()
    {
        return $this->hasMany(Message::class,'user_rec_id','id');//->withPivot('body')->withTimestamps();
    }

    public function offres()
    {
        return $this->hasMany(Offre::class,'user_id');
    }
    /*public function postule()
    {
        return $this->belongsToMany(Offre::class,'postuler','user_id','offre_id')->withPivot('message', 'cv','realisation_id')->withTimestamps();
    }*/
    public function postule()
    {
        return $this->belongsToMany(Offre::class,'postuler','user_id','offre_id')->using(Postuler::class);
        //return $this->belongsToMany(User::class,'postuler','offre_id','user_id')->withPivot('message','cv','realisation_id')->withTimestamps();
    }

    public function reponsePostuler()
    {
    return $this->hasMany(ReponsePostuler::class,'user_id');
    }

    public function portfolio()
    {
    return $this->hasOne(Portfolio::class,'user_id');
    
    }
   /* public function sendPasswordResetNotification($token){

    $this->notify(new \App\Notifications\MailResetPasswordNotification($token));
    }*/
}
