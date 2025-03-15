<div class="w-full">
    <div class="relative {{ $mobile ? 'mt-3 md:hidden' : 'hidden md:block flex-grow mx-4' }}" wire:ignore.self>
        <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <input type="text" wire:model.live="searchQuery" // Eliminamos el debounce temporalmente
            class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary"
            placeholder="Buscar..." x-on:input="console.log('Search Query:', $event.target.value)">

        @if (strlen($searchQuery) >= 3 && count($searchResults) > 0)
        <div class="absolute z-10 mt-2 bg-white border border-gray-300 rounded-md shadow-lg w-full">
            <ul>
                @foreach ($searchResults as $product)
                <li class="p-2 hover:bg-gray-100 flex items-center">
                    <img src="{{ $product->image }}" alt="{{ $product->name }}"
                        class="w-12 h-12 object-cover rounded mr-2">
                    <div>
                        <a href="{{ route('product.details', $product->slug) }}" class="block font-medium">
                            {{ $product->name }}
                        </a>
                        <span class="text-sm text-gray-500">
                            {{ $product->subcategory->name }}
                        </span>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <script>
        document.addEventListener('livewire:updated', function () {
            console.log('Search Results:', @json($searchResults));
        });
    </script>
</div>