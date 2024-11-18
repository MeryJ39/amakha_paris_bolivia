<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel eCommerce</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <style></style>
    @endif

    @livewireStyles
</head>
<body class="font-sans antialiased bg-gray-50 text-black dark:bg-black dark:text-white">
    <!-- Incluye el navbar -->
    @include('layouts.navbar')

    <!-- Contenido dinámico de la página -->
    @yield('content')

    <!-- Incluye el footer -->
    @include('layouts.footer')
    @livewireScripts

</body>
</html>
