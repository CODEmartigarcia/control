<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 font-sans antialiased">
    <!-- Header -->
    <header>
        @include('partials.header')
    </header>

    <!-- Contenido principal -->
    <div class="container mx-auto mt-6">
        @yield('content')
    </div>
    <script>
        document.getElementById('menu-toggle').addEventListener('click', () => {
            const menu = document.getElementById('menu');
            menu.classList.toggle('hidden');
        });

    </script>
</body>

</html>