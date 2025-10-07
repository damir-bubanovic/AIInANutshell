<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    protected $fillable = ['slug','title','tagline','summary','position'];

    public function lessons() { 
        return $this->hasMany(Lesson::class)->orderBy('position'); 
    }
}
