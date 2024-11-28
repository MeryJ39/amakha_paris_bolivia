<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestión de Pedidos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Mensaje de éxito -->
                    @if (session('success'))
                        <div class="mb-4 text-green-600">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Filtros -->
                    <div class="mb-6 flex flex-col md:flex-row justify-between items-center gap-4">
                        <form method="GET" action="{{ route('admin.orders.index') }}" class="w-full md:w-auto flex flex-wrap gap-4">
                            <!-- Filtro por estado -->
                            <select name="status" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary transition-all">
                                <option value="">{{ __('Estado') }}</option>
                                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>{{ __('Pendiente') }}</option>
                                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>{{ __('Procesando') }}</option>
                                <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>{{ __('Enviado') }}</option>
                                <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>{{ __('Entregado') }}</option>
                            </select>

                            <!-- Filtro por número de pedido -->
                            <input type="text" name="search" value="{{ request('search') }}" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary transition-all" placeholder="{{ __('Buscar por pedido #') }}">

                            <!-- Filtro por fecha -->
                            <input type="date" name="start_date" value="{{ request('start_date') }}" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary transition-all" placeholder="{{ __('Fecha de inicio') }}">
                            <input type="date" name="end_date" value="{{ request('end_date') }}" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary transition-all" placeholder="{{ __('Fecha de fin') }}">

                            <!-- Botón de búsqueda -->
                            <button type="submit" class="px-6 py-2 bg-black text-white rounded-lg shadow-md hover:bg-gray-800 transition-all"> {{ __('Filtrar') }} <i class="fa-solid fa-filter"></i></button>
                        </form>
                    </div>

                    <!-- Tabla de pedidos -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 rounded-lg shadow-md">
                            <thead class="bg-black text-white">
                                <tr>
                                    <th class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Pedido #") }}
                                    </th>
                                    <th class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Cliente") }}
                                    </th>
                                    <th class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Estado") }}
                                    </th>
                                    <th class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Detalles") }}
                                    </th>
                                    <th class="px-6 py-3 text-sm font-medium text-left border-b border-gray-300 dark:border-gray-700">
                                        {{ __("Acciones") }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-primary hover:text-primary-dark transition-all">
                                                {{ $order->id }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            {{ $order->user->name }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            {{ ucfirst($order->status) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            <a href="{{ route('admin.orders.show', $order->id) }}" class="text-primary hover:text-primary-dark transition-all">
                                                {{ __('Ver Detalles') }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100 border-b border-gray-300 dark:border-gray-700">
                                            <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('POST')
                                                <select name="status" class="px-2 py-1 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary transition-all">
                                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>{{ __('Pendiente') }}</option>
                                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>{{ __('Procesando') }}</option>
                                                    <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>{{ __('Enviado') }}</option>
                                                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>{{ __('Entregado') }}</option>
                                                </select>
                                                <button type="submit" class="ml-2 bg-black text-white px-4 py-2 rounded-lg shadow-md hover:bg-gray-800 transition-all">
                                                    {{ __('Actualizar') }}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginación -->
                    <div class="mt-4">
                        {{ $orders->links('pagination::tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
