<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
    <div id="app" class="page-content flex flex-col">
        <header class="flex-initial">
            @include('includes.navbar')
        </header>

        <main class="flex-auto">
            <div class="container">
                {{ $slot }}
            </div>
        </main>

        <footer class="flex-initial">
            <div class="container">
                Подвал
            </div>
        </footer>
    </div>
</body>
</html>
