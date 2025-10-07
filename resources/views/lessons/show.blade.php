@extends('layouts.app')

@section('content')
<a href="{{ route('home') }}">← Back</a>
<h1>{{ $lesson->title }}</h1>
<p><em>{{ $lesson->summary }}</em></p>
<article>{!! nl2br(e($lesson->body)) !!}</article>
@endsection
