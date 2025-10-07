<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LessonRequest;
use App\Models\Chapter;
use App\Models\Lesson;

class LessonAdminController extends Controller
{
    public function index()
    {
        $lessons = Lesson::with('chapter')->orderBy('chapter_id')->orderBy('position')->get();
        return view('admin.lessons.index', compact('lessons'));
    }

    public function create()
    {
        return view('admin.lessons.form', ['lesson' => new Lesson(), 'chapters' => Chapter::orderBy('position')->get()]);
    }

    public function store(LessonRequest $request)
    {
        Lesson::create($request->validated());
        return redirect()->route('admin.lessons.index');
    }

    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.form', ['lesson' => $lesson, 'chapters' => Chapter::orderBy('position')->get()]);
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $lesson->update($request->validated());
        return redirect()->route('admin.lessons.index');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back();
    }
}
