<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight text-gray-800">Admin</h1>
        <div class="mt-2 flex items-center gap-4 text-sm">
            <a href="{{ route('admin.chapters.index') }}"
               class="{{ request()->routeIs('admin.chapters.*') ? 'underline font-medium' : 'text-gray-600 hover:underline' }}">
               Chapters
            </a>
            <a href="{{ route('admin.lessons.index') }}"
               class="{{ request()->routeIs('admin.lessons.*') ? 'underline font-medium' : 'text-gray-600 hover:underline' }}">
               Lessons
            </a>
        </div>
    </x-slot>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-6">
        @yield('admin')
    </div>
</x-app-layout>
