<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LessonRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $lesson = $this->route('lesson'); // null on create
        // chapter_id may come from form select
        $chapterId = $this->input('chapter_id') ?: optional($lesson)->chapter_id;

        return [
            'chapter_id' => ['required','exists:chapters,id'],
            'title' => ['required','string','max:255'],
            'slug' => ['required','string','max:255',"unique:lessons,slug,".optional($lesson)->id.",id,chapter_id,{$chapterId}"],
            'summary' => ['nullable','string'],
            'body' => ['nullable','string'],
            'position' => ['required','integer','min:1'],
            'estimated_minutes' => ['required','integer','min:1','max:240'],
            'published_at' => ['nullable','date'],
            'cover_image' => ['nullable','image','mimes:jpg,jpeg,png,webp','max:2048'],
        ];
    }
}
