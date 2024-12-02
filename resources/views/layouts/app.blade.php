<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<header>
    @include('partials.header')
</header>

<body>
    <div class="font-sans text-gray-900 antialiased">
        @yield('content')
    </div>
</body>

</html>