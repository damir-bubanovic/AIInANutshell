<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapter_id',
        'slug',
        'title',
        'summary',
        'body',
        'position',
        'estimated_minutes',
        'published_at',
        'cover_image_path',
        'view_count',
    ];

    protected $casts = [
        'published_at' => 'datetime',
        'view_count'   => 'integer',
    ];

    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }

    protected static function booted()
    {
        static::saved(fn() => cache()->forget('home:chapters'));
        static::deleted(fn() => cache()->forget('home:chapters'));
    }
}
