<div class="max-w-4xl mx-auto my-10 bg-white p-6 rounded-lg shadow-lg">
    <!-- Primera fila: Imagen, Nombre, Estrellas, Precio y Botones -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Imagen del producto -->
        <div class="w-full mb-6 md:mb-0 flex justify-center">
            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="w-full max-w-sm rounded-lg shadow-md">
        </div>

        <!-- Detalles del producto (Nombre y Estrellas) -->
        <div class="w-full flex flex-col justify-center items-center md:items-start">
            <h2 class="text-3xl font-bold text-gray-800 text-center md:text-left">{{ $product->name }}</h2>
            <div class="my-2">
                <livewire:product-rating :product="$product" wire:key="product-rating-{{ $product->id }}" />
            </div>
        </div>

        <!-- Precio y Controles de cantidad (Derecha) -->
        <div class="w-full flex flex-col justify-center items-center md:items-end">
            <!-- Mostrar precio con descuento si existe -->
            @if ($discountAmount > 0)
                <!-- Precio Original Tachado -->
                <p class="text-lg font-bold text-gray-500 line-through">Bs {{ number_format($product->price, 2) }}</p>
                <!-- Precio con Descuento -->
                <p class="text-3xl font-bold text-red-600">Bs {{ number_format($finalPrice, 2) }}</p>
            @else
                <!-- Precio normal si no hay descuento -->
                @auth
                    @if (auth()->user()->role_id == 2)
                        <p class="text-3xl font-bold text-gray-900 text-center md:text-right">Bs {{ number_format($consultorPrice, 2) }}</p>
                    @else
                        <p class="text-3xl font-bold text-gray-900 text-center md:text-right">Bss {{ number_format($product->price, 2) }}</p>
                    @endif
                @endauth
             @endif

            <!-- Controles de cantidad -->
            <div class="mt-4 flex items-center space-x-3 justify-center md:justify-end">
                <button wire:click="decreaseQuantity" class="px-4 py-2 bg-black text-white rounded-full hover:bg-gray-700 disabled:opacity-50 transition" {{ $quantity <= 1 ? 'disabled' : '' }}>-</button>
                <input type="text" id="quantity" name="quantity" value="{{ $quantity }}" class="w-12 text-center border-2 border-gray-300 rounded-lg py-2">
                <button wire:click="increaseQuantity" class="px-4 py-2 bg-black text-white rounded-full hover:bg-gray-700 transition">+</button>
            </div>

            <!-- Botón de añadir al carrito -->
            <div class="mt-6 w-full max-w-xs">
                @if ($isInCart)
                    <button class="w-full bg-primary text-black py-3 rounded-lg cursor-not-allowed opacity-75">
                        <i class="fas fa-check"></i> Agregado al carrito
                    </button>
                @else
                    <button wire:click="addToCart" class="w-full bg-primary text-black py-3 rounded-lg hover:bg-yellow-400 transition">
                        <i class="fas fa-cart-plus"></i> Añadir al carrito
                    </button>
                @endif
            </div>
        </div>
    </div>

    <!-- Segunda fila: Descripción -->
    <div class="mt-6">
        <h3 class="text-xl font-semibold text-gray-800 mb-4 text-center">Descripción</h3>
        <div class="text-sm text-gray-600 leading-relaxed">
            <p>{{ $product->description }}</p>
        </div>
    </div>
</div>
