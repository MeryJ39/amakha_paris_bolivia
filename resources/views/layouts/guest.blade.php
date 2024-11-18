<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-center bg-no-repeat bg-[url('https://res.cloudinary.com/dqyo3iajp/image/upload/v1731512398/wp1879450-perfume-wallpapers_gwi7wu.webp')] bg-gray-100 bg-blend-multiply dark:bg-gray-900">


            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white bg-opacity-20 dark:bg-gray-800 dark:bg-opacity-40 backdrop-blur-lg shadow-lg rounded-lg overflow-hidden">

                {{ $slot }}
            </div>

        </div>
    </body>
</html>
