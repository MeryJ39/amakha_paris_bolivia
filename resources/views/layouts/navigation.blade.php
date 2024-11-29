<!-- Botón para abrir el sidebar (en pantallas pequeñas) -->
<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-1 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 8 14">
       <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 13 5.7-5.326a.909.909 0 0 0 0-1.348L1 1"/>
   </svg>
</button>

<!-- Sidebar -->
<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-white dark:bg-gray-800">
       <!-- Logo -->
       <a href="{{ route('dashboard') }}" class="flex items-center ps-2.5 mb-5">
          <x-application-logo class="" />
       </a>

       <!-- Menú de navegación -->
       <ul class="space-y-2 font-medium">
        @php
            $userRoleId = auth()->user()->role_id; // Suponiendo que el campo 'role_id' está en la tabla 'users'
        @endphp

        <!-- Dashboard -->
        @if ($userRoleId == 1)  <!-- Admin o Superadmin -->
            <li>
                <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-tachometer-alt w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Dashboard</span>
                </a>
            </li>
        @endif

        <!-- Gestión de Pedidos -->
        @if ($userRoleId == 1 || $userRoleId == 4)  <!-- Admin, Superadmin o Manager -->
            <li>
                <a href="{{ route('admin.orders.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-boxes w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Gestión de Pedidos</span>
                </a>
            </li>
        @endif

        <!-- Gestión de Categorías -->
        @if ($userRoleId == 1)  <!-- Admin o Superadmin -->
            <li>
                <a href="{{ route('admin.categories.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-th-large w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Gestión de Categorías</span>
                </a>
            </li>
        @endif

        <!-- Gestión de Subcategorías -->
        @if ($userRoleId == 1)  <!-- Admin o Superadmin -->
            <li>
                <a href="{{ route('admin.subcategories.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-th-list w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Gestión de Subcategorías</span>
                </a>
            </li>
        @endif

        <!-- Gestión de Productos -->
        @if ($userRoleId == 1 || $userRoleId == 4)  <!-- Admin, Superadmin o Manager -->
            <li>
                <a href="{{ route('admin.products.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-cogs w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Gestión de Productos</span>
                </a>
            </li>
        @endif

        <!-- Gestión de Usuarios -->
        @if ($userRoleId == 1)  <!-- Admin o Superadmin -->
            <li>
                <a href="{{ route('admin.users.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-users w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Gestión de Usuarios</span>
                </a>
            </li>
        @endif

        <!-- Gestión de Roles -->
        @if ($userRoleId == 1)  <!-- Solo para Superadmin -->
            <li>
                <a href="{{ route('admin.roles.index', 1) }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-user-shield w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Gestión de Roles</span>
                </a>
            </li>
        @endif

        <!-- Gestión de Descuentos -->
        @if ($userRoleId == 1 || $userRoleId == 4)  <!-- Admin o Superadmin -->
            <li>
                <a href="{{ route('admin.discounts.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-tag w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Gestión de Descuentos</span>
                </a>
            </li>
        @endif

        <!-- Perfil -->
        <li>
            <a href="{{ route('profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fas fa-user-circle w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                <span class="ms-3">Perfil</span>
            </a>
        </li>

        <!-- Mis Pedidos -->
        @if ($userRoleId == 2 || $userRoleId == 3)
        <li>
            <a href="{{ route('orders') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fas fa-box w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                <span class="ms-3">Mis Pedidos</span>
            </a>
        </li>
        @endif

        <!-- Gestión de Direcciones -->
        @if ($userRoleId == 2 || $userRoleId == 3)
        <li>
            <a href="{{ route('addresses.index') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fas fa-map-marker-alt w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                <span class="ms-3">Mis Direcciones</span>
            </a>
        </li>
        @endif

            <!-- Volver a la tienda -->
            <li>
                <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <i class="fas fa-home w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                <span class="ms-3">Volver a la tienda</span>
                </a>
            </li>

            <!-- Autenticación (Logout) -->
            <li>
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <i class="fas fa-sign-out-alt w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
                    <span class="ms-3">Cerrar sesión</span>
                </button>
                </form>
            </li>

       </ul>
    </div>
 </aside>


<!-- Contenido principal -->
<div class="p-0 sm:ml-64">

</div>

<!-- Script para el sidebar (en pantallas pequeñas) -->
<script>
   // Script para abrir y cerrar el sidebar en pantallas pequeñas
   document.querySelector('[data-drawer-toggle="logo-sidebar"]').addEventListener('click', function() {
      document.getElementById('logo-sidebar').classList.toggle('-translate-x-full');
   });
</script>
