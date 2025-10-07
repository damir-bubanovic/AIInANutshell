<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $lessons = collect();

        if ($q !== '') {
            // FULLTEXT search (requires the fulltext index on lessons: title, summary, body)
            $lessons = Lesson::with('chapter')
                ->whereNotNull('published_at')
                ->select('*')
                ->whereRaw("MATCH(title, summary, body) AGAINST (? IN BOOLEAN MODE)", [$q])
                ->orderByDesc('published_at')
                ->paginate(10)
                ->appends(['q' => $q]);
        }

        return view('search.index', compact('q', 'lessons'));
    }
}
