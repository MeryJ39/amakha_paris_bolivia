<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel</title>
    <meta name="description" content="Descripción de tu página para SEO">
    <meta name="keywords" content="palabras, clave, relevantes">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    @vite(['resources/css/app.css','resources/js/app.js'])


</head>
<body>

    @include('Web.partials.header')
    @yield('contenido')
    @include('Web.partials.footer')
    @include('Web.partials.js')
    @stack('scripts')
</body>
</html>
