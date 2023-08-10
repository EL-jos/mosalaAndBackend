<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $incrementing = false;

    public function student(){
        return $this->belongsTo(Student::class);
    }

    public function types(){
        return $this->belongsToMany(Type::class);
    }

    public function cities(){
        return $this->belongsToMany(City::class);
    }

    public function sector(){
        return $this->belongsTo(Sector::class);
    }
}
