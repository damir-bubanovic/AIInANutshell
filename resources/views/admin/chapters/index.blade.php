@extends('admin.layout')

@section('admin')
  <div class="mb-4">
    <a href="{{ route('admin.chapters.create') }}" class="badge">+ New Chapter</a>
  </div>

  <div class="grid gap-3">
    @forelse($chapters as $c)
      <div class="card flex items-center justify-between">
        <div>
          <div class="font-semibold">{{ $c->title }}</div>
          <div class="text-xs text-gray-500">
            slug: {{ $c->slug }} • pos: {{ $c->position }}
            @if($c->tagline) • tagline: "{{ $c->tagline }}" @endif
          </div>
        </div>
        <div class="flex gap-2">
          <a class="badge" href="{{ route('admin.chapters.edit', $c) }}">Edit</a>
          <form method="POST" action="{{ route('admin.chapters.destroy', $c) }}">
            @csrf @method('DELETE')
            <button class="badge" onclick="return confirm('Delete chapter?')">Delete</button>
          </form>
        </div>
      </div>
    @empty
      <div class="text-sm text-gray-600">No chapters yet.</div>
    @endforelse
  </div>
@endsection
