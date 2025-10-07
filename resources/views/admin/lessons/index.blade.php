@extends('admin.layout')

@section('admin')
  <div class="mb-4">
    <a href="{{ route('admin.lessons.create') }}" class="badge">+ New Lesson</a>
  </div>

  <div class="grid gap-3">
    @forelse($lessons as $l)
      <div class="card">
        <div class="flex items-center justify-between">
          <div>
            <div class="font-semibold">{{ $l->title }}</div>
            <div class="text-xs text-gray-500">
              chapter: {{ $l->chapter->title }} • slug: {{ $l->slug }} • pos: {{ $l->position }} • {{ $l->estimated_minutes }}m
            </div>
            <div class="text-xs {{ $l->published_at ? 'text-green-700' : 'text-yellow-700' }}">
              {{ $l->published_at ? 'Published '.$l->published_at->toDateTimeString() : 'Draft' }}
            </div>
          </div>
          <div class="flex gap-2">
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
