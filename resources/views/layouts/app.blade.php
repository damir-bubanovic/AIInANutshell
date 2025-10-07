<!doctype html>
<html lang="en" class="h-full">
<head>
  <meta charset="utf-8">
  <title>{{ config('app.name', 'AI in a Nutshell') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite(['resources/js/app.js'])
</head>
<body class="min-h-full bg-gray-50 text-gray-900">
  <header class="border-b bg-white">
    <div class="container-nutshell flex items-center justify-between py-4">
      <a href="{{ route('home') }}" class="text-xl font-semibold">AI in a Nutshell</a>
      <nav class="flex gap-6 text-sm">
        <a href="{{ route('home') }}" class="hover:text-gray-700">Home</a>
        <a class="text-gray-400 cursor-not-allowed">About</a>
      </nav>
    </div>
  </header>

  <main class="container-nutshell py-8">
    @yield('content')
  </main>

  <footer class="mt-12 border-t">
    <div class="container-nutshell py-6 text-sm text-gray-500">
      © {{ date('Y') }} AI in a Nutshell
    </div>
  </footer>
</body>
</html>
