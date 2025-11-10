<!DOCTYPE html>
<html lang="en" data-theme="autumn">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ isset($title) ? $title.' - CALLA' : 'CALLA' }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@5/themes.css" rel="stylesheet" type="text/css" />

    <link href="https://fonts.googleapis.com/css2?family=Goudy+Bookletter+1911&family=Inter:wght@400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans">
    <x-navbar/>

    @if(session('success'))
        <x-toast :message="session('success')" />
    @endif

    <div class="pt-16">
        {{ $slot }}
    </div>


    <script src="{{ asset('js/app.tsx') }}"></script>
    @stack('scripts')
</body>
</html>
