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
        return view('admin.lessons.form', [
            'lesson' => new Lesson(),
            'chapters' => Chapter::orderBy('position')->get(),
        ]);
    }

    public function store(LessonRequest $request)
    {
        $data = $request->validated();

        if ($request->boolean('publish_now') && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $request->file('cover_image')->store('lesson-covers', 'public');
        }

        Lesson::create($data);
        return redirect()->route('admin.lessons.index');
    }

    public function edit(Lesson $lesson)
    {
        return view('admin.lessons.form', [
            'lesson' => $lesson,
            'chapters' => Chapter::orderBy('position')->get(),
        ]);
    }

    public function update(LessonRequest $request, Lesson $lesson)
    {
        $data = $request->validated();

        if ($request->boolean('publish_now') && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        if ($request->hasFile('cover_image')) {
            $data['cover_image_path'] = $request->file('cover_image')->store('lesson-covers', 'public');
        }

        $lesson->update($data);
        return redirect()->route('admin.lessons.index');
    }

    public function destroy(Lesson $lesson)
    {
        $lesson->delete();
        return back();
    }
}
