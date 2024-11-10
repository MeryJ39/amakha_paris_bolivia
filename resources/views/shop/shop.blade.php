<!-- resources/views/shop/shop.blade.php -->
@extends('shop.app')

@section('content')
<main class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-3xl font-semibold mb-6">Our Products</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            <!-- Producto 1 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/400" alt="Producto 1" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Product 1</h3>
                    <p class="text-gray-600 mt-2">$29.99</p>
                    <button class="mt-4 w-full py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">Add to Cart</button>
                </div>
            </div>

            <!-- Producto 2 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/400" alt="Producto 2" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Product 2</h3>
                    <p class="text-gray-600 mt-2">$49.99</p>
                    <button class="mt-4 w-full py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">Add to Cart</button>
                </div>
            </div>

            <!-- Producto 3 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/400" alt="Producto 3" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Product 3</h3>
                    <p class="text-gray-600 mt-2">$69.99</p>
                    <button class="mt-4 w-full py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">Add to Cart</button>
                </div>
            </div>

            <!-- Producto 4 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="https://via.placeholder.com/400" alt="Producto 4" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h3 class="text-lg font-semibold">Product 4</h3>
                    <p class="text-gray-600 mt-2">$99.99</p>
                    <button class="mt-4 w-full py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700">Add to Cart</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
