<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>AI in a Nutshell</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    body{font-family:system-ui,-apple-system,Segoe UI,Roboto,Ubuntu;max-width:900px;margin:2rem auto;padding:0 1rem}
    nav a{margin-right:1rem;text-decoration:none}
    .card{border:1px solid #ddd;border-radius:12px;padding:1rem;margin:.5rem 0}
  </style>
</head>
<body>
<nav>
  <a href="{{ route('home') }}">Home</a>
</nav>
<main>@yield('content')</main>
</body>
</html>
