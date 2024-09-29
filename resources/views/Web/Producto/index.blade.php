@extends('welcome')

@section('contenido')
<div class="max-w-4xl mx-auto my-10 bg-white p-6 rounded-lg shadow-lg">
    <div class="flex flex-col md:flex-row">
        <!-- Imagen del producto -->
        <div class="w-full md:w-1/3 mb-6 md:mb-0">
            <img src="{{ asset($product->image_path) }}" alt="{{ $product->name }}" class="w-full rounded-lg">
        </div>
        <!-- Detalles del producto -->
        <div class="w-full md:w-2/3 pl-0 md:pl-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
            <div class="flex items-center my-2">
                <span class="text-gray-500">★★★★★</span>
                <span class="ml-2 text-sm text-gray-500">(0)</span>
            </div>
            <ul class="my-4 space-y-2">
                <li><strong>Detalles:</strong> {{ $product->details }}</li>
                <li><strong>Descripción:</strong> {{ $product->description }}</li>
            </ul>
            <div class="mt-6">
                <p class="text-gray-500 line-through">Bs {{ $product->precio_venta }}</p>
                <p class="text-3xl font-bold">Bs {{ $product->price }}</p>
                <p class="text-sm text-gray-500">En hasta 1x Bs {{ $product->price }} sin intereses</p>
            </div>

            <!-- Opciones -->
            <div class="mt-6">
                <label for="quantity" class="block text-sm font-medium text-gray-700">Cantidad</label>
                <div class="flex items-center space-x-3">
                    <button class="px-3 py-2 bg-secondary text-white  rounded">-</button>
                    <input type="text" id="quantity" name="quantity" value="1" class="w-12 text-center border border-gray-300 rounded py-2">
                    <button class="px-3 py-2 bg-secondary text-white rounded">+</button>
                </div>
            </div>

            <!-- Botón de añadir al carrito -->
            <div class="mt-6">
                <button class="w-full bg-primary text-white py-3 rounded-lg font-bold hover:bg-primary transition">
                    Añadir al Carrito
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
