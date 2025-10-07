{{-- resources/views/search/index.blade.php --}}
<x-app-layout>
  <x-slot name="header">
    <h1 class="text-2xl font-semibold text-gray-800">Search</h1>
  </x-slot>

  <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-6">
    <form action="{{ route('search') }}" method="GET" class="mb-4">
      <input type="search" name="q" value="{{ $q }}" placeholder="Search lessons…"
             class="w-full rounded-md border-gray-300">
    </form>

    @if($q === '')
      <p class="text-gray-600 text-sm">Type to search titles, summaries, and bodies.</p>
    @else
      <p class="text-gray-600 text-sm mb-3">
        Results for “{{ $q }}”
        @if($lessons instanceof \Illuminate\Pagination\LengthAwarePaginator) • {{ $lessons->total() }} found @endif
      </p>

      <div class="grid gap-3">
        @forelse($lessons as $l)
          <a class="card block" href="{{ route('lesson.show', [$l->chapter->slug, $l->slug]) }}">
            <h3 class="text-lg font-semibold">{{ $l->title }}</h3>
            @if($l->summary)<p class="text-sm text-gray-600 line-clamp-2">{{ $l->summary }}</p>@endif
            <div class="mt-2 text-xs text-gray-500">
              {{ $l->estimated_minutes }} min • {{ optional($l->published_at)->toFormattedDateString() }}
            </div>
          </a>
        @empty
          <p class="text-sm text-gray-600">No matches.</p>
        @endforelse
      </div>

      @if($lessons instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="mt-4">{{ $lessons->links() }}</div>
      @endif
    @endif
  </div>
</x-app-layout>
