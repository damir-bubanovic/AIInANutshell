@php
  $title = 'AI in a Nutshell';
  $metaDescription = 'Practical micro-lessons.';
@endphp

<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight text-[#0B2A4A]">{{ __('AI in a Nutshell') }}</h1>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-6">
        <div class="prose max-w-none">
            <p class="lead text-gray-700">Small lessons. Real gains.</p>
        </div>

        @foreach($chapters as $chapter)
            <section class="mt-8">
                <div class="flex items-end justify-between">
                    <div>
                        <h2 class="text-2xl font-semibold text-[#0B2A4A]">{{ $chapter->title }}</h2>
                        @if($chapter->tagline)
                            <p class="text-gray-600">{{ $chapter->tagline }}</p>
                        @endif
                    </div>
                </div>

                <div class="mt-4 grid gap-4 sm:grid-cols-2">
                    @foreach($chapter->lessons as $lesson)
                        <a href="{{ route('lesson.show', [$chapter->slug, $lesson->slug]) }}"
                           class="flex items-start gap-4 rounded-lg bg-white/5 p-3 hover:bg-white/10 transition">
                            <!-- Thumbnail -->
                            <div class="relative h-16 w-28 flex-shrink-0 overflow-hidden rounded-md bg-gray-100 ring-1 ring-black/10">
                                <img
                                    src="{{ $lesson->image_url ?? asset('images/placeholder-cover.svg') }}"
                                    alt="{{ $lesson->title }}"
                                    class="absolute inset-0 h-full w-full object-cover"
                                    loading="lazy"
                                    decoding="async"
                                >
                            </div>

                            <!-- Lesson text -->
                            <div class="min-w-0">
                                <h3 class="text-base font-semibold text-[#0B2A4A] hover:text-[#D4A017]">
                                    {{ $lesson->title }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600 line-clamp-2">{{ $lesson->summary }}</p>
                                <div class="mt-2 flex items-center gap-3 text-xs text-gray-500">
                                    <span>{{ $lesson->estimated_minutes }} min</span>
                                    @if($lesson->published_at)
                                        <span>Published {{ $lesson->published_at->diffForHumans() }}</span>
                                    @endif
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endforeach
    </div>
</x-app-layout>
