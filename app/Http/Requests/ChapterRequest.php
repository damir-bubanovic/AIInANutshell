<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChapterRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        $chapter = $this->route('chapter'); // null on create
        return [
            'title' => ['required','string','max:255'],
            'slug' => ['required','string','max:255','unique:chapters,slug,'.optional($chapter)->id],
            'tagline' => ['nullable','string','max:255'],
            'summary' => ['nullable','string'],
            'position' => ['required','integer','min:1'],
        ];
    }
}
