<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use App\Models\Lesson;

use Illuminate\Http\Request;
use League\CommonMark\MarkdownConverter;


class LessonController extends Controller
{
    
    public function index()
    {
        $chapters = Chapter::with(['lessons' => fn($q) => $q->whereNotNull('published_at')])->orderBy('position')->get();
        return view('lessons.index', compact('chapters'));
    }

    public function show(Chapter $chapter, Lesson $lesson)
    {
        abort_unless($lesson->chapter_id === $chapter->id, 404);
        $converter = new MarkdownConverter(); // CommonMark + basic inline HTML off by default
        $html = $converter->convert((string) $lesson->body)->getContent();
        return view('lessons.show', compact('chapter','lesson','html'));
    }

}
