<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard eCommerce</title>
    @vite('resources/css/app.css')

</head>
<body class="bg-gray-100">
    <header class="bg-gray-800 text-white p-4 flex justify-between items-center">
        <h1 class="text-2xl font-semibold">Dashboard eCommerce</h1>
        <nav>
            <ul class="flex space-x-4">
                <li><a href="#" class="hover:underline">Inicio</a></li>
                <li><a href="#" class="hover:underline">Productos</a></li>
                <li><a href="#" class="hover:underline">Pedidos</a></li>
                <li><a href="#" class="hover:underline">Usuarios</a></li>
                <li>
                    <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
                </li>
            </ul>
        </nav>
    </header>

    <div class="container mx-auto p-6">
        <main>
            <div class="bg-white p-6 rounded-lg shadow-md mb-6">
                <h2 class="text-xl font-semibold mb-4">Estadísticas Clave</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-blue-500 text-white p-4 rounded-lg flex flex-col items-center">
                        <i class="fas fa-dollar-sign text-4xl mb-2"></i>
                        <h3 class="text-lg font-semibold">Ventas Totales</h3>
                        <p class="text-2xl">${{ number_format(123456.78, 2) }}</p>
                    </div>
                    <div class="bg-green-500 text-white p-4 rounded-lg flex flex-col items-center">
                        <i class="fas fa-box text-4xl mb-2"></i>
                        <h3 class="text-lg font-semibold">Productos</h3>
                        <p class="text-2xl">{{ 42 }}</p>
                    </div>
                    <div class="bg-yellow-500 text-white p-4 rounded-lg flex flex-col items-center">
                        <i class="fas fa-shopping-cart text-4xl mb-2"></i>
                        <h3 class="text-lg font-semibold">Pedidos</h3>
                        <p class="text-2xl">{{ 123 }}</p>
                    </div>
                    <div class="bg-red-500 text-white p-4 rounded-lg flex flex-col items-center">
                        <i class="fas fa-users text-4xl mb-2"></i>
                        <h3 class="text-lg font-semibold">Usuarios</h3>
                        <p class="text-2xl">{{ 456 }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Últimos Pedidos</h2>
                <ul class="space-y-2">
                    <li class="border-b border-gray-200 py-2">Pedido #1001 - 20/08/2024 - $123.45</li>
                    <li class="border-b border-gray-200 py-2">Pedido #1002 - 21/08/2024 - $67.89</li>
                    <li class="border-b border-gray-200 py-2">Pedido #1003 - 22/08/2024 - $45.67</li>
                    <li class="border-b border-gray-200 py-2">Pedido #1004 - 23/08/2024 - $89.01</li>
                    <li class="border-b border-gray-200 py-2">Pedido #1005 - 24/08/2024 - $12.34</li>
                </ul>
            </div>
        </main>
    </div>

    <footer class="bg-gray-800 text-white text-center p-4 mt-6">
        <p>&copy; {{ date('Y') }} Tu Tienda eCommerce</p>
    </footer>

    <!-- Font Awesome for icons -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
