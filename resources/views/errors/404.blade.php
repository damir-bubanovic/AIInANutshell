<x-app-layout>
  <x-slot name="header">
    <h1 class="text-2xl font-semibold text-gray-800">Page not found</h1>
  </x-slot>

  <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-10">
    <div class="card">
      <p class="text-gray-700">We couldn’t find that page.</p>

      <div class="mt-4 flex flex-wrap items-center gap-3">
        <a href="{{ route('home') }}" class="badge">Go home</a>
        <form action="{{ route('search') }}" method="GET" class="flex-1 min-w-[240px]">
          <input type="search" name="q" placeholder="Search lessons…" class="w-full rounded-md border-gray-300">
        </form>
      </div>
    </div>
  </div>
</x-app-layout>
