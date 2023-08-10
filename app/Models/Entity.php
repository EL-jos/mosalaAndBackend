<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $incrementing = false;

    public function entityable(){
        return $this->morphTo();
    }
}
