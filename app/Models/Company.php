<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $incrementing = false;

    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }

    public function about(){
        return $this->morphOne(About::class, 'aboutable');
    }

    public function entity(){
        return $this->morphOne(Entity::class, 'entityable');
    }

    public function sector(){
        return $this->belongsTo(Sector::class);
    }

}
