<x-app-layout>
  <x-slot name="header"><h1 class="text-2xl font-semibold text-gray-800">Page expired</h1></x-slot>
  <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-10">
    <div class="card">
      <p class="text-gray-700">Please refresh and try again.</p>
      <div class="mt-4"><a href="{{ url()->previous() }}" class="badge">Go back</a></div>
    </div>
  </div>
</x-app-layout>
