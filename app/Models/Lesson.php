<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'chapter_id','slug','title','summary','body','position','estimated_minutes','published_at'
    ];

    public function chapter() { 
        return $this->belongsTo(Chapter::class); 
    }

    protected $casts = ['published_at' => 'datetime'];
}
