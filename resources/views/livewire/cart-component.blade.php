<div>
    <!-- Cart Content -->
    <div class="cart-items space-y-4 mt-4">
        @if($cartItems->isNotEmpty())
            @foreach($cartItems as $item)
                <!-- Renderizamos el componente CartItemComponent -->
                <livewire:cart-item-component :cartItemId="$item->cart_item_id" wire:key="cart-item-{{ $item->cart_item_id }}-{{ $total }}" />
            @endforeach
        @else
            <p class="text-gray-500 text-center">No hay productos en tu carrito.</p>
        @endif
    </div>

    <!-- Total del carrito -->
    <div class="total mt-6 p-4 bg-gray-100 rounded shadow">
        <h3 class="text-lg font-bold">Total: Bs {{ number_format($total, 2) }}</h3>
    </div>
</div>
