<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Carbon\Carbon;


class NutshellSeeder extends Seeder
{
    public function run(): void
    {
        $chapter = Chapter::updateOrCreate(
            ['slug' => 'everyday-ai'],
            [
                'title' => 'Everyday AI',
                'tagline' => 'Small lessons. Real gains.',
                'summary' => 'Practical micro-lessons for general users.',
                'position' => 1,
            ]
        );

        $lessons = [
            ['Prompt patterns', 'Reusable templates for better answers.'],
            ['Summarize anything', 'Collapse long text into key points.'],
            ['Rewrite an email', 'Tone, clarity, and brevity.'],
            ['Extract from PDFs', 'Pull tables and fields fast.'],
            ['Plan with constraints', 'Deadlines, budgets, dependencies.'],
            ['Create checklists', 'Repeatable steps that prevent errors.'],
            ['Image-to-text', 'Describe screenshots or photos.'],
            ['Privacy basics', 'What to share and what not to.'],
        ];

        foreach ($lessons as $i => [$title, $summary]) {
            Lesson::updateOrCreate(
                ['chapter_id' => $chapter->id, 'slug' => Str::slug($title)],
                [
                    'title' => $title,
                    'summary' => $summary,
                    'body' => "# {$title}\n\nComing soon.",
                    'position' => $i + 1,
                    'estimated_minutes' => 5,
                    'published_at' => Carbon::now(),
                ]
            );
        }
    }
}
