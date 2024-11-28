<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalles del Pedido') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-4">{{ __("Pedido #") . $order->order_number }}</h3>

                    <div class="mb-6">
                        <p><strong>{{ __("Fecha de Pedido: ") }}</strong>{{ $order->created_at->format('d-m-Y') }}</p>
                        <p><strong>{{ __("Estado de Pago: ") }}</strong>{{ ucfirst($order->payment_status) }}</p>
                        <p><strong>{{ __("Estado del Pedido: ") }}</strong>{{ ucfirst($order->status) }}</p>
                        <p><strong>{{ __("Método de Pago: ") }}</strong>{{ ucfirst($order->payment_method) }}</p>
                        <p><strong>{{ __("Total: ") }}</strong>${{ number_format($order->total_amount, 2) }}</p>
                    </div>

                    <div class="mb-6">
                        <h4 class="text-lg font-semibold">{{ __("Dirección de Envío:") }}</h4>
                        <p>{{ $order->address->street }}, {{ $order->address->city }}, {{ $order->address->state }}, {{ $order->address->country }} - {{ $order->address->postal_code }}</p>
                    </div>

                    <h4 class="mt-6 text-lg font-semibold">{{ __("Productos en este Pedido:") }}</h4>
                    <ul class="list-disc pl-5">
                        @foreach ($orderItems as $item)
                            <li>{{ $item->product->name }} - ${{ number_format($item->price_at_purchase, 2) }} x {{ $item->quantity }} = ${{ number_format($item->total_at_purchase, 2) }}</li>
                        @endforeach
                    </ul>

                    <a href="{{ route('orders') }}" class="mt-4 text-blue-600 hover:text-blue-900">{{ __("Volver a Mis Pedidos") }}</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
