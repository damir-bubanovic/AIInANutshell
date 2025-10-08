<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chapter;
use App\Models\Lesson;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class NutshellSeeder extends Seeder
{
    public function run(): void
    {
        // ensure public/lesson-covers exists
        if (! Storage::disk('public')->exists('lesson-covers')) {
            Storage::disk('public')->makeDirectory('lesson-covers');
        }

        $chapter = Chapter::updateOrCreate(
            ['slug' => 'everyday-ai'],
            [
                'title'   => 'Everyday AI',
                'tagline' => 'Small lessons. Real gains.',
                'summary' => 'Practical micro-lessons for general users.',
                'position'=> 1,
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
            $slug = Str::slug($title);

            $lesson = Lesson::updateOrCreate(
                ['chapter_id' => $chapter->id, 'slug' => $slug],
                [
                    'title'             => $title,
                    'summary'           => $summary,
                    'body'              => "# {$title}\n\nComing soon.",
                    'position'          => $i + 1,
                    'estimated_minutes' => 5,
                    'published_at'      => Carbon::now(),
                ]
            );

            if (empty($lesson->cover_image_path)) {
                $url = "https://picsum.photos/seed/{$slug}/1200/630";
                try {
                    $resp = Http::timeout(10)->get($url);
                    if ($resp->successful()) {
                        $path = "lesson-covers/{$slug}.jpg";
                        Storage::disk('public')->put($path, $resp->body());
                        $lesson->cover_image_path = $path;
                        $lesson->save();
                    }
                } catch (\Throwable $e) {
                    // ignore network issues; lesson remains without image
                }
            }
        }
    }
}
