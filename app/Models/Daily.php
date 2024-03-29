<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Daily extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $incrementing = false;


    public function students(){
        return $this->belongsToMany(Student::class);
    }

    public function day(){
        return $this->belongsTo(Day::class);
    }
}
