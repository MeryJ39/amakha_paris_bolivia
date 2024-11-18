<div class="max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-semibold mb-6">Our Products</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $product)
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" wire:key="product-{{ $product->id }}">
                <div class="relative">
                    <!-- Imagen del Producto -->
                    <img class="p-6 h-72 object-contain w-full rounded-t-lg"
                        src="{{ $product->image }}"
                        alt="{{ $product->name }} image"
                        loading="lazy" />
                </div>
                <div class="px-5 pb-5">
                    <!-- Nombre del Producto -->
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h5>

                    <!-- Estrellas de Calificación -->
                    <!-- Estrellas de Calificación -->
<div class="flex items-center mt-2.5 mb-5">
    <livewire:product-rating :product="$product" wire:key="product-rating-{{ $product->id }}" />
</div>


                    <!-- Precio y Botón de Añadir al Carrito -->
                    <div class="flex items-center justify-between mt-4">
                        <span class="text-2xl font-custom font-extrabold text-gray-900 dark:text-white">Bs {{ number_format($product->price, 2) }}</span>

                        @if(in_array($product->id, $cartProductIds))
                            <!-- Mostrar si el producto está en el carrito -->
                            <span class="text-sm text-green-600">Ya en el carrito</span>
                        @else
                            <!-- Botón de Añadir al Carrito -->
                            <button wire:click="addToCart({{ $product->id }})"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Add to Cart
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
