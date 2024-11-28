<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Mis Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-semibold mb-4">{{ __("Pedidos Realizados") }}</h3>

                    @if($orders->isEmpty())
                        <p class="text-lg">{{ __("No tienes pedidos aún.") }}</p>
                    @else
                        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700">
                            <thead>
                                <tr class="text-left">
                                    <th class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Número de Pedido") }}
                                    </th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Fecha") }}
                                    </th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Método de Pago") }}
                                    </th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Estado de Pago") }}
                                    </th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Estado del Pedido") }}
                                    </th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Total") }}
                                    </th>
                                    <th class="px-6 py-3 text-sm font-medium text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Acciones") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            {{ $order->order_number }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            {{ $order->created_at->format('d-m-Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            {{ ucfirst($order->payment_method) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            {{ ucfirst($order->payment_status) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            {{ ucfirst($order->status) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            ${{ number_format($order->total_amount, 2) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            <a href="{{ route('orders.show', $order->id) }}" class="text-blue-600 hover:text-blue-900">{{ __("Ver detalles") }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
