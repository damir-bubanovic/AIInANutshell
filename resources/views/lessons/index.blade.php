<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight text-gray-800">{{ __('AI in a Nutshell') }}</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="prose max-w-none">
            <p class="lead">Small lessons. Real gains.</p>
        </div>

        @foreach($chapters as $chapter)
            <section class="mt-8">
                <div class="flex items-end justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold">{{ $chapter->title }}</h2>
                        @if($chapter->tagline)
                            <p class="text-gray-600">{{ $chapter->tagline }}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    @foreach($chapter->lessons as $lesson)
                        <a class="card block" href="{{ route('lesson.show', [$chapter->slug, $lesson->slug]) }}">
                            <h3 class="text-lg font-semibold">{{ $lesson->title }}</h3>
                            <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ $lesson->summary }}</p>
                            <div class="mt-3 flex items-center gap-3 text-xs text-gray-500">
                                <span class="badge">{{ $lesson->estimated_minutes }} min</span>
                                @if($lesson->published_at)
                                    <span>Published {{ $lesson->published_at->diffForHumans() }}</span>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</x-app-layout>
