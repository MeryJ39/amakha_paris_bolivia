<div class="max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-semibold mb-6">Nuestros productos</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $product)
            <!-- Envolvemos la tarjeta del producto en un enlace que redirige a la página de detalles -->
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700" wire:key="product-{{ $product->id }}">
                <div class="relative">
                    <!-- Enlace para la imagen que redirige a la página de detalles -->
                    <a href="{{ route('product.details', $product->slug) }}">
                        <!-- Imagen del Producto -->
                        <img class="p-6 h-72 object-contain w-full rounded-t-lg"
                            src="{{ $product->image }}"
                            alt="{{ $product->name }} image"
                            loading="lazy"
                        />
                    </a>
                </div>
                <div class="px-5 pb-5">
                    <!-- Nombre del Producto -->
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h5>

                    <!-- Estrellas de Calificación -->
                    <div class="flex items-center mt-2.5 mb-5">
                        <livewire:product-rating :product="$product" wire:key="product-rating-{{ $product->id }}" />
                    </div>

                    <!-- Mostrar Precio Original y Descuento -->
                    <div class="flex flex-col mt-4">
                        @php
                            // Aplicamos los descuentos si existen
                            $discountData = $this->applyDiscounts($product);
                            $discountAmount = $discountData['discount_amount'];
                            $consultorPrice = $discountData['consultor_price'];
                            $finalPrice = $discountAmount > 0 ? $product->price - $discountAmount : $consultorPrice;



                        @endphp

                        <!-- Mostrar Precio Original solo si hay descuento -->
                        @if($discountAmount > 0)
                            <span class="text-2xl font-custom font-extrabold text-gray-900 dark:text-white line-through">
                                Bs {{ number_format($product->price, 2) }}
                            </span>
                        @endif

                        <!-- Mostrar Descuento si Existe -->
                        @if($discountAmount > 0)
                            <span class="text-lg text-red-600">
                                Ahorras: Bs {{ number_format($discountAmount, 2) }}
                            </span>

                            <!-- Precio Final después del Descuento -->
                            <span class="text-2xl font-custom font-extrabold text-green-600">
                                Ahora: Bs {{ number_format($finalPrice, 2) }}
                            </span>
                        @else

                            <span class="text-2xl font-custom font-extrabold text-gray-900 dark:text-white">
                                Bs {{ number_format($finalPrice, 2) }}
                            </span>

                        @endif
                    </div>

                    <!-- Estatus del Carrito -->
                    <div class="flex items-center justify-between mt-4">
                        @if(in_array($product->id, $cartProductIds))
                            <!-- Mostrar si el producto está en el carrito -->
                            <span class="text-sm text-green-600">Ya en el carrito</span>
                        @else
                            <!-- Botón de Añadir al Carrito -->
                            <button wire:click="addToCart({{ $product->id }})"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Añadir al carrito
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
