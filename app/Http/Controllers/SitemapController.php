<?php

namespace App\Http\Controllers;

use App\Models\Chapter;
use Illuminate\Support\Str;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    public function index(): Response
    {
        $host = rtrim(config('app.url'), '/');
        $urls = [];

        // Home
        $urls[] = ['loc' => $host . route('home', [], false), 'changefreq' => 'daily', 'priority' => '0.8'];

        // Lessons (published only)
        Chapter::with(['lessons' => fn($q) => $q->whereNotNull('published_at')])->get()
            ->each(function ($chapter) use (&$urls, $host) {
                foreach ($chapter->lessons as $lesson) {
                    $urls[] = [
                        'loc'        => $host . route('lesson.show', [$chapter->slug, $lesson->slug], false),
                        'lastmod'    => optional($lesson->published_at)->toAtomString(),
                        'changefreq' => 'monthly',
                        'priority'   => '0.6',
                    ];
                }
            });

        $xml = view('sitemap.xml', compact('urls'))->render();
        return response($xml, 200)->header('Content-Type', 'application/xml');
    }
}
