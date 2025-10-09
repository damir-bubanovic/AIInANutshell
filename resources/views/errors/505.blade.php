<x-app-layout>
  <x-slot name="header"><h1 class="text-2xl font-semibold text-gray-800">Server error</h1></x-slot>
  <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-10">
    <div class="card">
      <p class="text-gray-700">Something went wrong. Try again later.</p>
      <div class="mt-4"><a href="{{ route('home') }}" class="badge">Go home</a></div>
    </div>
  </div>
</x-app-layout>
