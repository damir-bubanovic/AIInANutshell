<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:underline">← {{ __('Back') }}</a>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-6">
        <article class="prose lg:prose-lg max-w-none">
            <h1>{{ $lesson->title }}</h1>
            @if($lesson->summary)
                <p><em>{{ $lesson->summary }}</em></p>
            @endif
            {!! nl2br(e($lesson->body)) !!}
        </article>
    </div>
</x-app-layout>
