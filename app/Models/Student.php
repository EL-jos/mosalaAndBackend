<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $incrementing = false;

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function bac(){
        return $this->hasOne(Bac::class);
    }

    public function entity(){
        return $this->morphOne(Entity::class, 'entityable');
    }

    public function about(){
        return $this->morphOne(About::class, 'aboutable');
    }

    public function category(){
        return $this->hasOneThrough(Category::class, Bac::class, 'category_id', 'id', 'bac_id');
    }

    public function formations(){
        return $this->belongsToMany(Formation::class);
    }

    public function competencies(){
        return $this->belongsToMany(Competency::class);
    }

    public function dailies(){
        return $this->belongsToMany(Daily::class);
    }

    public function periodicals(){
        return $this->belongsToMany(Periodical::class);
    }

    public function requests(){
        return $this->hasMany(Request::class);
    }
}
