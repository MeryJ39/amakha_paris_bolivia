<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Detalles del Pedido') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm dark:bg-gray-800 sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="mb-4 text-2xl font-semibold">{{ __("Pedido #") . $order->order_number }}</h3>

                    <div class="mb-6">
                        <p><strong>{{ __("Fecha de Pedido: ") }}</strong>{{ $order->created_at->format('d-m-Y') }}</p>
                        <p><strong>{{ __("Estado de Pago: ") }}</strong>{{ ucfirst($order->payment_status) }}</p>
                        <p><strong>{{ __("Estado del Pedido: ") }}</strong>{{ ucfirst($order->status) }}</p>
                        <p><strong>{{ __("Método de Pago: ") }}</strong>{{ ucfirst($order->payment_method) }}</p>
                        <p><strong>{{ __("Total: ") }}</strong>${{ number_format($order->total_amount, 2) }}</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-lg font-semibold">{{ __("Dirección de Envío:") }}</h4>
                        <p>{{ $order->address->street }}, {{ $order->address->city }}, {{ $order->address->state }}, {{
                            $order->address->country }} - {{ $order->address->postal_code }}</p>
                    </div>

                    <h4 class="mt-6 text-lg font-semibold">{{ __("Productos en este Pedido:") }}</h4>
                    <ul class="pl-5 list-disc">
                        @foreach ($orderItems as $item)
                        <li>{{ $item->product->name }} - ${{ number_format($item->price_at_purchase, 2) }} x {{
                            $item->quantity }} = ${{ number_format($item->total_at_purchase, 2) }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('orders') }}" class="mt-4 text-blue-600 hover:text-blue-900">{{ __("Volver a Mis
                        Pedidos") }}</a>

                    {{-- Botón para Iniciar/Ir al Chat --}}
                    @if ($order->chat) {{-- Si ya existe un chat para este pedido --}}
                    <a href="{{ route('chats.show', $order->chat) }}"
                        class="inline-block px-4 py-2 mt-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                        {{ __("Ir al Chat") }}
                    </a>
                    @else {{-- Si no existe un chat --}}
                    <form action="{{ route('chats.store', $order) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 mt-4 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            {{ __("Iniciar Chat") }}
                        </button>
                    </form>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>