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
    <link href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Goudy+Bookletter+1911&family=Inter:wght@400;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.tsx'])
</head>

<body class="min-h-screen flex flex-col bg-base-200 font-sans">
    <x-navbar/>

    @if (session('success'))
        <x-toast :message="session('success')" type="success" />
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <x-toast :message="$error" type="error" />
        @endforeach
    @endif


    <div class="pt-16">
        {{ $slot }}
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('searchComponent', () => ({
                query: '',
                results: [],
                loading: false,
                open: false,

                search() {
                    if (this.query.length < 2) {
                        this.open = false;
                        return;
                    }

                    this.loading = true;
                    this.open = true;

                    fetch(`/search?q=${encodeURIComponent(this.query)}`)
                        .then(res => res.json())
                        .then(data => {
                            this.results = data;
                        })
                        .finally(() => {
                            this.loading = false;
                        });
                }
            }));
        });
    </script>


    @stack('scripts')
</body>
</html>
