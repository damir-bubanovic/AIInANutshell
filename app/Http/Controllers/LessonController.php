<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use League\CommonMark\CommonMarkConverter;

class LessonController extends Controller
{
    public function index()
    {
        $chapters = Chapter::with(['lessons' => fn ($q) => $q->whereNotNull('published_at')])
            ->orderBy('position')
            ->get();

        return view('lessons.index', compact('chapters'));
    }

    public function show(Chapter $chapter, Lesson $lesson)
    {
        abort_unless($lesson->chapter_id === $chapter->id, 404);

        // 30-minute debounce per visitor (session + IP)
        $key = sprintf('lesson:%d:view:%s:%s', $lesson->id, session()->getId(), request()->ip());
        if (Cache::add($key, true, now()->addMinutes(30))) {
            $lesson->increment('view_count');
        }

        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $markdown = (string) ($lesson->body ?? '');
        $html = $converter->convert($markdown)->getContent();

        return view('lessons.show', compact('chapter', 'lesson', 'html'));
    }
}
