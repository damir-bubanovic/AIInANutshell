<x-app-layout>
    <x-slot name="header">
        <a href="{{ route('home') }}" class="text-sm text-gray-600 hover:underline">← {{ __('Back') }}</a>
    </x-slot>

    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-6">
        @if($lesson->cover_image_path)
            <img
                src="{{ asset('storage/'.$lesson->cover_image_path) }}"
                alt="{{ $lesson->title }}"
                class="mb-4 w-full rounded-xl object-cover"
            >
        @endif

        <article class="prose lg:prose-lg max-w-none">
            <h1>{{ $lesson->title }}</h1>
            @if($lesson->summary)
                <p><em>{{ $lesson->summary }}</em></p>
            @endif

            {{-- $html is Markdown-rendered content from controller. Fallback to escaped text. --}}
            {!! $html ?? nl2br(e($lesson->body)) !!}
        </article>

        <div class="mt-6 text-xs text-gray-500">
            @if($lesson->published_at)
                <span>Published {{ $lesson->published_at->toDayDateTimeString() }}</span>
            @else
                <span>Draft</span>
            @endif
            · <span>{{ $lesson->estimated_minutes }} min read</span>
        </div>
    </div>
</x-app-layout>
