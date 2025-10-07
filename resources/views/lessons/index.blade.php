@extends('layouts.app')

@section('content')
<h1>AI in a Nutshell</h1>
@foreach($chapters as $chapter)
  <h2>{{ $chapter->title }}</h2>
  <p>{{ $chapter->tagline }}</p>
  @foreach($chapter->lessons as $lesson)
    <div class="card">
      <h3>
        <a href="{{ route('lesson.show', [$chapter->slug, $lesson->slug]) }}">
          {{ $lesson->title }}
        </a>
      </h3>
      <p>{{ $lesson->summary }}</p>
      <small>{{ $lesson->estimated_minutes }} min</small>
    </div>
  @endforeach
@endforeach
@endsection
