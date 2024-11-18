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

        @livewireStyles  <!-- Asegúrate de tener esta línea aquí -->

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="container mx-auto py-8">

            <!-- Botón Volver Atrás -->
            <button onclick="window.history.back()" class="bg-gray-200 text-gray-800 py-2 px-4 rounded-md mb-6 hover:bg-gray-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 12H5m7 7l-7-7 7-7"></path>
                </svg>
                Volver Atrás
            </button>

            <h2 class="text-4xl font-semibold mb-6 text-center">Checkout</h2>

            <!-- Mensaje de éxito -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-md mb-6 text-center">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex gap-8">
                <!-- Carrito de compras (usamos el componente Livewire aquí) -->
                <div class="w-full md:w-2/3 bg-white shadow-md rounded-lg p-6">
                    <h3 class="text-2xl font-semibold mb-4">Tu carrito</h3>

                    <!-- Aquí cargamos el CartComponent que se encargará de manejar todos los productos -->
                    <livewire:cart-component />

                </div>

                <!-- Formulario de checkout -->
                <div class="w-full md:w-1/3 bg-gray-100 p-6 rounded-lg shadow-md">
                    <h3 class="text-2xl font-semibold mb-6">Detalles de pago</h3>

                    <form action="{{ route('checkout.process') }}" method="POST">
                        @csrf

                        <!-- Dirección de envío -->
                        <div class="mb-6">
                            <label for="address" class="block text-sm font-medium text-gray-700">Dirección de envío</label>
                            <input type="text" name="address" id="address" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" value="{{ old('address') }}" required>
                            @error('address')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Método de pago -->
                        <div class="mb-6">
                            <label for="payment_method" class="block text-sm font-medium text-gray-700">Método de pago</label>
                            <select name="payment_method" id="payment_method" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                                <option value="credit_card">Tarjeta de crédito</option>
                                <option value="paypal">PayPal</option>
                            </select>
                            @error('payment_method')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botón de confirmación -->
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-200">Confirmar Compra</button>
                    </form>
                </div>
            </div>
        </div>

        @livewireScripts <!-- Asegúrate de tener esta línea al final del archivo -->
    </body>
</html>
