<div class="cart-item flex items-center justify-between p-3 border-b">
    <div class="flex items-center space-x-3">
        <!-- Imagen y nombre del producto -->
        <img class="w-14 h-14 object-cover rounded" src="{{ $productImage }}" alt="{{ $productName }}">
        <div>
            <h3 class="text-sm font-semibold">{{ $productName }}</h3>
        </div>
    </div>

    <div class="flex items-center space-x-2">
        <!-- Botón para decrementar la cantidad -->
        <button
            wire:click="decrementQuantity"
            class="w-8 h-8 flex items-center justify-center border rounded hover:bg-gray-200"
            aria-label="Disminuir cantidad"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
            </svg>
        </button>

        <!-- Cantidad actual -->
        <span class="font-semibold text-sm">{{ $quantity }}</span>

        <!-- Botón para incrementar la cantidad -->
        <button
            wire:click="incrementQuantity"
            class="w-8 h-8 flex items-center justify-center border rounded hover:bg-gray-200"
            aria-label="Incrementar cantidad"
        >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="w-4 h-4 text-gray-600" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
        </button>

        <!-- Total con descuento aplicado -->
        <span class="font-semibold text-sm">
            Bs {{ number_format(($price - $unitDiscount) * $quantity, 2) }}
        </span>

        <!-- Botón para eliminar ítem del carrito -->
        <button
            wire:click="removeItem"
            class="text-red-500 hover:text-red-700"
            aria-label="Eliminar ítem"
        >
            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
            </svg>
        </button>
    </div>
</div>

<!-- Agregar código JavaScript al final -->
<script>
    // Escucha del evento para mostrar el mensaje de advertencia si el stock es insuficiente
    Livewire.on('showStockWarning', (data) => {
        alert(data.message); // Muestra el mensaje de advertencia al usuario
    });
</script>
