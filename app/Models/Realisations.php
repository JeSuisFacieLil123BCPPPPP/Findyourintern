<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*use App\Models\Tag;
use App\Models\Image;
use App\Models\File;
use App\Models\Comments;
use App\Models\User;*/
use Shetabit\Visitor\Traits\Visitable;
//use App\Models\Postulants;
class Realisations extends Model
{
    use HasFactory;
    //use Visitable;
//id,title,description,nbr_vue,etat,

    protected $fillable = [
        'title','description','nbr_vue','nbrLikes','nbrdisLikes','valide','user_id',/*'entity_id','filiere_id',*/'visibility'
    ];

    protected $casts = [
        'valide' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /*public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }*/
   /* public function image()
    {
        return $this->morphMany('Image', 'imageable', 'imageable_type', 'imageable_id');
    }*/
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'realisationTags','realisation_id','tag_id')->withTimestamps();;
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable')->where('type_model', 'images');
        //return $this->morphMany(Image::class, 'imageable');
    }
    public function poster()

    {
        return $this->morphOne(Image::class, 'imageable')->where('type_model', 'poster');
    }
   /* public function file()
    {
        return $this->morphMany('File', 'fileable');
    }*/
    public function video()
    {
        return $this->morphOne(File::class, 'fileable')->where('type_model', 'video');
    }
    public function documents()
    {
        return $this->morphMany(File::class, 'fileable')->where('type_model', 'documents');
    }
    public function comments()
    {
        return $this->hasMany(Comments::class,'realisation_id','id');
    }
    public function userRealReactions()
    {
        return $this->belongsToMany(User::class,'reactionsRealisation','realisation_id','user_id')->withPivot('like', 'dislike')->withTimestamps();
    }

    public function entity()
    {
        return $this->belongsTo(Entity::class);
    }
    public function filiere()
    {
        return $this->belongsTo(Filiere::class);
    }


    public function realisationsPostuler()
    {
        return $this->belongsToMany(Postuler::class,'postuler_realisations',/*'realisation_id','postuler_id'*/)->withTimestamps();
    }

}
