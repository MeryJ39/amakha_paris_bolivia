<div class="max-w-7xl mx-auto px-6">
    <h2 class="text-3xl font-semibold mb-6">Productos en la subcategoría: {{ $subcategory->name }}</h2>

    <!-- Lista de productos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @foreach($products as $product)
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="relative">
                    <a href="{{ route('product.details', $product->slug) }}">
                        <img class="p-6 h-72 object-contain w-full rounded-t-lg"
                            src="{{ $product->image }}"
                            alt="{{ $product->name }} image"
                            loading="lazy"
                        />
                    </a>
                </div>
                <div class="px-5 pb-5">
                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">{{ $product->name }}</h5>

                    <div class="flex items-center mt-2.5 mb-5">
                        <livewire:product-rating :product="$product" wire:key="product-rating-{{ $product->id }}" />
                    </div>

                    <div class="flex flex-col mt-4">
                        @php
                            $discountData = $this->applyDiscounts($product);
                            $discountAmount = $discountData['discount_amount'];
                            $finalPrice = $discountAmount > 0 ? $product->price - $discountAmount : $product->price;
                        @endphp

                        @if($discountAmount > 0)
                            <span class="text-2xl font-custom font-extrabold text-gray-900 dark:text-white line-through">
                                Bs {{ number_format($product->price, 2) }}
                            </span>
                        @endif

                        @if($discountAmount > 0)
                            <span class="text-lg text-red-600">
                                Ahorras: Bs {{ number_format($discountAmount, 2) }}
                            </span>
                            <span class="text-2xl font-custom font-extrabold text-green-600">
                                Ahora: Bs {{ number_format($finalPrice, 2) }}
                            </span>
                        @else
                            <span class="text-2xl font-custom font-extrabold text-gray-900 dark:text-white">
                                Bs {{ number_format($finalPrice, 2) }}
                            </span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between mt-4">
                        @if(in_array($product->id, $cartProductIds))
                            <span class="text-sm text-green-600">Ya en el carrito</span>
                        @else
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
