@extends('layouts.app')

@section('content')
  <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:underline">← Back</a>

  <article class="prose lg:prose-lg max-w-none mt-4">
    <h1>{{ $lesson->title }}</h1>
    @if($lesson->summary)
      <p><em>{{ $lesson->summary }}</em></p>
    @endif
    {!! nl2br(e($lesson->body)) !!}
  </article>
@endsection
