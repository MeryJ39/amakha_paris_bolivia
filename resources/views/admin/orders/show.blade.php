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
                    <h3 class="mb-4 text-2xl font-semibold">{{ __("Pedido #") }} {{ $order->order_number }}</h3>

                    <h4 class="text-lg font-semibold">{{ __("Cliente:") }} {{ $order->user->name }}</h4>
                    <p class="mb-4">{{ $order->user->email }}</p>

                    <h4 class="text-lg font-semibold">{{ __("Dirección de Envío:") }}</h4>
                    <p class="mb-4">{{ $order->address->address }}, {{ $order->address->city }}, {{
                        $order->address->department }}</p>
                    <p class="mb-4">{{ __("Teléfono:") }} {{ $order->address->phone_number }}</p>

                    <form action="{{ route('admin.orders.start_chat', $order) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="px-4 py-2 mt-6 font-bold text-white bg-blue-500 rounded hover:bg-blue-700">
                            Iniciar Chat
                        </button>
                    </form>

                    <h4 class="text-lg font-semibold">{{ __("Productos:") }}</h4>
                    <table
                        class="min-w-full bg-white border border-gray-300 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
                        <thead class="text-white bg-black">
                            <tr>
                                <th
                                    class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                    {{ __("Producto") }}
                                </th>
                                <th
                                    class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                    {{ __("Cantidad") }}
                                </th>
                                <th
                                    class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                    {{ __("Precio (BOB)") }}
                                </th>
                                <th
                                    class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                    {{ __("Total (BOB)") }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                <td
                                    class="px-6 py-4 text-sm text-gray-900 border-b border-gray-300 dark:text-gray-100 dark:border-gray-700">
                                    {{ $item->product->name }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-900 border-b border-gray-300 dark:text-gray-100 dark:border-gray-700">
                                    {{ $item->quantity }}
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-900 border-b border-gray-300 dark:text-gray-100 dark:border-gray-700">
                                    {{ number_format($item->price_at_purchase * 7, 2) }} BOB
                                </td>
                                <td
                                    class="px-6 py-4 text-sm text-gray-900 border-b border-gray-300 dark:text-gray-100 dark:border-gray-700">
                                    {{ number_format($item->total_at_purchase * 7, 2) }} BOB
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <h4 class="mt-4 text-lg font-semibold">{{ __("Total del Pedido:") }} {{
                        number_format($order->total_amount * 7, 2) }} BOB</h4>

                    <a href="{{ route('admin.orders.index') }}"
                        class="inline-block mt-6 text-primary hover:text-primary-dark">
                        {{ __("Volver a la lista de pedidos") }}
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>