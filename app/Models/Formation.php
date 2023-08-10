<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $incrementing = false;

    public function students(){
        return $this->belongsToMany(Student::class);
    }
}
