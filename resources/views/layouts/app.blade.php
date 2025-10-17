<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        @php
          $appName = config('app.name', 'AI in a Nutshell');
          $title = trim(($title ?? '') ? ($title.' | '.$appName) : $appName);
          $desc = $metaDescription ?? 'Small lessons. Real gains.';
          $url = rtrim(config('app.url'), '/') . request()->getPathInfo();
          $image = $metaImage ?? null;
        @endphp
        <title>{{ $title }}</title>
        <meta name="description" content="{{ $desc }}">

        <link rel="canonical" href="{{ $url }}"/>

        <meta property="og:type" content="website">
        <meta property="og:title" content="{{ $title }}">
        <meta property="og:description" content="{{ $desc }}">
        @if($image)<meta property="og:image" content="{{ $image }}">@endif
        <meta property="og:url" content="{{ $url }}">
        <meta name="twitter:card" content="summary_large_image">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
        <body class="font-sans antialiased flex flex-col min-h-screen bg-gray-100">
          @include('layouts.navigation')

          @isset($header)
            <header class="bg-white shadow">
              <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
              </div>
            </header>
          @endisset

          <main class="flex-1 pb-16">  {{-- matches footer height (h-14 ≈ 56px) --}}
            {{ $slot }}
          </main>

          <x-footer />
        </body>
</html>
