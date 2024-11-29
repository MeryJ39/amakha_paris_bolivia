<x-app-layout>


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    {{-- Mostrar gráficos y estadísticas para Admin (role_id 1) o Personal (role_id 4) --}}
                    @if ($userRoleId == 1 || $userRoleId == 4)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Resumen de Ventas -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                <div>
                                    <h5 class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($todaySales, 2) }}</h5>
                                    <p class="text-gray-500 dark:text-gray-400">Ventas hoy</p>
                                </div>
                                <div class="text-4xl text-blue-500 dark:text-blue-400">
                                    <i class="fas fa-calendar-day"></i>
                                </div>
                            </div>

                            <!-- Venta Esta Semana -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                <div>
                                    <h5 class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($weeklySales, 2) }}</h5>
                                    <p class="text-gray-500 dark:text-gray-400">Ventas esta semana</p>
                                </div>
                                <div class="text-4xl text-green-500 dark:text-green-400">
                                    <i class="fas fa-calendar-week"></i>
                                </div>
                            </div>

                            <!-- Venta Este Mes -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                <div>
                                    <h5 class="text-3xl font-bold text-gray-900 dark:text-white">{{ number_format($monthlySales, 2) }}</h5>
                                    <p class="text-gray-500 dark:text-gray-400">Ventas este mes</p>
                                </div>
                                <div class="text-4xl text-yellow-500 dark:text-yellow-400">
                                    <i class="fas fa-calendar-month"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Productos con Bajo Stock -->
                        <div class="mt-8">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-gray-100">Productos con Bajo Stock</h3>
                            <ul class="mt-4 text-gray-700 dark:text-gray-300 space-y-2">
                                @foreach($lowStockProducts as $product)
                                    <li class="flex justify-between items-center border-b border-gray-200 dark:border-gray-700 pb-2">
                                        <span>{{ $product->name }} ({{ $product->stock }} en stock)</span>
                                        <span class="text-red-500 font-semibold">{{ $product->stock }} en stock</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Gráfico de Ventas por Día -->
                        <div class="mt-8">
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
                                <div class="flex justify-between items-center mb-4">
                                    <h5 class="text-3xl font-semibold text-gray-900 dark:text-white">Ventas por Día</h5>
                                    <p class="text-gray-500 dark:text-gray-400">Último mes</p>
                                </div>
                                <div id="area-chart"></div>
                            </div>
                        </div>
                    @endif

                    {{-- Mostrar tarjetas para Consultor (role_id 2) o Cliente (role_id 3) --}}
                    @if ($userRoleId == 2 || $userRoleId == 3)
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <!-- Total de Pedidos del Usuario -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                <div>
                                    <h5 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $totalOrders }}</h5>
                                    <p class="text-gray-500 dark:text-gray-400">Total de Pedidos</p>
                                </div>
                                <div class="text-4xl text-blue-500 dark:text-blue-400">
                                    <i class="fas fa-boxes"></i>
                                </div>
                            </div>

                            <!-- Detalle del Último Pedido -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                <div>
                                    <h5 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $lastOrder->id ?? 'No hay pedidos' }}</h5>
                                    <p class="text-gray-500 dark:text-gray-400">Último Pedido</p>
                                </div>
                                <div class="text-4xl text-green-500 dark:text-green-400">
                                    <i class="fas fa-truck"></i>
                                </div>
                            </div>

                            <!-- Resumen de los Datos del Usuario -->
                            <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6 flex items-center justify-between border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 transition duration-200">
                                <div>
                                    <h5 class="text-3xl font-bold text-gray-900 dark:text-white">{{ $user->name }}</h5>
                                    <p class="text-gray-500 dark:text-gray-400">Datos de Usuario</p>
                                </div>
                                <div class="text-4xl text-yellow-500 dark:text-yellow-400">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>

                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Script para cargar el gráfico -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Configuración del gráfico de ventas por día
            var options = {
                chart: {
                    type: 'area',
                    height: 350,
                    zoom: {
                        enabled: false
                    },
                    toolbar: {
                        show: false
                    }
                },
                series: [{
                    name: 'Ventas ($)',
                    data: @json($salesByDay->pluck('total'))
                }],
                xaxis: {
                    categories: @json($salesByDay->pluck('date')),
                    title: {
                        text: 'Fecha'
                    },
                    labels: {
                        rotate: -45
                    }
                },
                yaxis: {
                    title: {
                        text: 'Ventas ($)'
                    },
                    labels: {
                        formatter: function (value) {
                            return '$' + value.toFixed(2);
                        }
                    }
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy'
                    },
                    y: {
                        formatter: function (value) {
                            return '$' + value.toFixed(2);
                        }
                    }
                },
                fill: {
                    colors: ['#38bdf8'], // Color de la gráfica
                    type: 'gradient',
                    gradient: {
                        opacityFrom: 0.7,
                        opacityTo: 0.3,
                        stops: [0, 100, 100]
                    }
                },
                stroke: {
                    curve: 'smooth',
                    width: 2
                }
            };

            var chart = new ApexCharts(document.querySelector("#area-chart"), options);
            chart.render();
        });
    </script>

</x-app-layout>
