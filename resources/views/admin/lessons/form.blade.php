@extends('admin.layout')

@section('admin')
  <form method="POST" class="card grid gap-4"
        action="{{ $lesson->exists ? route('admin.lessons.update', $lesson) : route('admin.lessons.store') }}">
    @csrf
    @if($lesson->exists) @method('PUT') @endif

    <div>
      <label class="block text-sm">Chapter</label>
      <select class="mt-1 w-full rounded-md border-gray-300" name="chapter_id" required>
        @foreach($chapters as $c)
          <option value="{{ $c->id }}" @selected(old('chapter_id',$lesson->chapter_id)==$c->id)>{{ $c->title }}</option>
        @endforeach
      </select>
      @error('chapter_id')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="grid sm:grid-cols-2 gap-4">
      <div>
        <label class="block text-sm">Title</label>
        <input class="mt-1 w-full rounded-md border-gray-300" name="title" value="{{ old('title',$lesson->title) }}" required>
        @error('title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm">Slug</label>
        <input class="mt-1 w-full rounded-md border-gray-300" name="slug" value="{{ old('slug',$lesson->slug) }}" required>
        @error('slug')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
    </div>

    <div>
      <label class="block text-sm">Summary</label>
      <input class="mt-1 w-full rounded-md border-gray-300" name="summary" value="{{ old('summary',$lesson->summary) }}">
      @error('summary')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="block text-sm">Body</label>
      <textarea class="mt-1 w-full rounded-md border-gray-300" name="body" rows="10">{{ old('body',$lesson->body) }}</textarea>
      @error('body')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="grid sm:grid-cols-3 gap-4">
      <div>
        <label class="block text-sm">Position</label>
        <input type="number" class="mt-1 w-full rounded-md border-gray-300" name="position" value="{{ old('position',$lesson->position ?? 1) }}" min="1" required>
        @error('position')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm">Minutes</label>
        <input type="number" class="mt-1 w-full rounded-md border-gray-300" name="estimated_minutes" value="{{ old('estimated_minutes',$lesson->estimated_minutes ?? 5) }}" min="1" max="240" required>
        @error('estimated_minutes')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm">Published at</label>
        <input type="datetime-local" class="mt-1 w-full rounded-md border-gray-300" name="published_at" value="{{ old('published_at', optional($lesson->published_at)->format('Y-m-d\TH:i')) }}">
        @error('published_at')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
    </div>

    <div><button class="badge">Save</button></div>
  </form>
@endsection
