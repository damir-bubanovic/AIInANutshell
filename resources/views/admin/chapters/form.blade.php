@extends('admin.layout')

@section('admin')
  <form method="POST" class="card grid gap-4"
        action="{{ $chapter->exists ? route('admin.chapters.update', $chapter) : route('admin.chapters.store') }}">
    @csrf
    @if($chapter->exists) @method('PUT') @endif

    <div>
      <label class="block text-sm">Title</label>
      <input class="mt-1 w-full rounded-md border-gray-300" name="title" value="{{ old('title',$chapter->title) }}" required>
      @error('title')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div class="grid sm:grid-cols-3 gap-4">
      <div>
        <label class="block text-sm">Slug</label>
        <input class="mt-1 w-full rounded-md border-gray-300" name="slug" value="{{ old('slug',$chapter->slug) }}" required>
        @error('slug')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
      <div>
        <label class="block text-sm">Position</label>
        <input type="number" class="mt-1 w-full rounded-md border-gray-300" name="position" value="{{ old('position',$chapter->position ?? 1) }}" min="1" required>
        @error('position')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
      </div>
    </div>

    <div>
      <label class="block text-sm">Tagline</label>
      <input class="mt-1 w-full rounded-md border-gray-300" name="tagline" value="{{ old('tagline',$chapter->tagline) }}">
      @error('tagline')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div>
      <label class="block text-sm">Summary</label>
      <textarea class="mt-1 w-full rounded-md border-gray-300" name="summary" rows="4">{{ old('summary',$chapter->summary) }}</textarea>
      @error('summary')<p class="text-red-600 text-sm">{{ $message }}</p>@enderror
    </div>

    <div><button class="badge">Save</button></div>
  </form>
@endsection
