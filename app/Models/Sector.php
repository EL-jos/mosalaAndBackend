<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;

    public function company(){
        return $this->hasOne(Company::class);
    }

    public function requests(){
        return $this->hasMany(Request::class);
    }
}
