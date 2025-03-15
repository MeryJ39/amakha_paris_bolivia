<!-- resources/views/shop/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel eCommerce</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=PT+Sans+Caption:wght@400;700&display=swap" rel="stylesheet">

    <script src="https://kit.fontawesome.com/6edb07306d.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


    @livewireStyles


    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    <style></style>
    @endif



</head>

<body class="font-sans antialiased text-black bg-gray-50 dark:bg-black dark:text-white">

    @php
    $categories = App\Models\Category::with('subcategories')->get();
    @endphp

    <!-- Incluye el navbar -->
    @include('shop.navbar', ['categories' => $categories])

    <!-- Contenido dinámico de la página -->
    @yield('content')

    <!-- Incluye el footer -->
    @include('shop.footer')



    @livewireScripts
</body>

</html>