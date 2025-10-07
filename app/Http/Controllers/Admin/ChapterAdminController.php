<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChapterRequest;
use App\Models\Chapter;

class ChapterAdminController extends Controller
{
    public function index()
    {
        $chapters = Chapter::orderBy('position')->get();
        return view('admin.chapters.index', compact('chapters'));
    }

    public function create()
    {
        return view('admin.chapters.form', ['chapter' => new Chapter()]);
    }

    public function store(ChapterRequest $request)
    {
        Chapter::create($request->validated());
        return redirect()->route('admin.chapters.index');
    }

    public function edit(Chapter $chapter)
    {
        return view('admin.chapters.form', compact('chapter'));
    }

    public function update(ChapterRequest $request, Chapter $chapter)
    {
        $chapter->update($request->validated());
        return redirect()->route('admin.chapters.index');
    }

    public function destroy(Chapter $chapter)
    {
        $chapter->delete();
        return back();
    }
}
