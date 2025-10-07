@extends('admin.layout')

@section('admin')
  <div class="mb-4 flex items-center justify-between">
    <div>
      <h2 class="text-lg font-semibold">Lessons</h2>
      <p class="text-xs text-gray-500">{{ $lessons->count() }} total</p>
    </div>
    <a href="{{ route('admin.lessons.create') }}" class="badge">+ New Lesson</a>
  </div>

  <div class="grid gap-3">
    @forelse($lessons as $l)
      <div class="card">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
          <div>
            <div class="flex items-center gap-2">
              <div class="font-semibold">{{ $l->title }}</div>
              @if($l->published_at)
                <span class="badge">Published</span>
              @else
                <span class="badge">Draft</span>
              @endif
            </div>

            <div class="mt-1 text-xs text-gray-500">
              Chapter: <span class="font-medium">{{ $l->chapter->title }}</span>
              • Slug: <code>{{ $l->slug }}</code>
              • Pos: {{ $l->position }}
              • {{ $l->estimated_minutes }}m
              @if($l->published_at)
                • {{ $l->published_at->toDayDateTimeString() }}
              @endif
            </div>

            @if($l->summary)
              <p class="mt-2 text-sm text-gray-600 line-clamp-2">{{ $l->summary }}</p>
            @endif

            <div class="mt-2 text-xs">
              <a class="underline text-gray-700"
                 href="{{ route('lesson.show', [$l->chapter->slug, $l->slug]) }}"
                 target="_blank" rel="noopener">
                 View public page ↗
              </a>
            </div>
          </div>

          <div class="flex items-center gap-2">
            <a class="badge" href="{{ route('admin.lessons.edit', $l) }}">Edit</a>
            <form method="POST" action="{{ route('admin.lessons.destroy', $l) }}">
              @csrf @method('DELETE')
              <button class="badge" onclick="return confirm('Delete lesson?')">Delete</button>
            </form>
          </div>
        </div>
      </div>
    @empty
      <div class="text-sm text-gray-600">No lessons yet.</div>
    @endforelse
  </div>
@endsection
