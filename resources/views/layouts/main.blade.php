<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'Calla Login')</title>
  <link href="https://fonts.googleapis.com/css2?family=Goudy+Bookletter+1911&family=Inter:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  @stack('styles')
</head>
<body>
  <div class="app-container">
    @yield('content')
  </div>

  <script src="{{ asset('js/app.js') }}"></script>
  @stack('scripts')
</body>
</html>
