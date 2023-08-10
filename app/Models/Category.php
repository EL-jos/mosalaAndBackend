<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function bacs(){
        return $this->hasMany(Bac::class);
    }

    public function students(){
        return $this->hasManyThrough(Student::class, Bac::class);
    }
}
