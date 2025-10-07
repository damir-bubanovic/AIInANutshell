<x-app-layout>
    <x-slot name="header">
        <h1 class="text-2xl font-semibold leading-tight text-gray-800">Admin</h1>
    </x-slot>

    <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 py-6">
        @yield('admin')
    </div>
</x-app-layout>
