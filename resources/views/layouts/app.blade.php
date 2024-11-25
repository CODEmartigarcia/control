<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Mi Aplicación')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <header>
        @include('partials.header') <!-- Aquí se incluye el header -->
    </header>

    <main>
        @yield('content') <!-- Contenido dinámico -->
    </main>

    <footer>
        <p>&copy; 2024 Mi Aplicación</p>
    </footer>
</body>

</html>