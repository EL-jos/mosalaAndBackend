<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bac extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $incrementing = false;

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function student(){
        return $this->belongsTo(Student::class);
    }
}
