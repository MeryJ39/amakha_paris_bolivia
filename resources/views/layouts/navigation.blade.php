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
         <!-- Dashboard -->
         <li>
            <a href="{{ route('dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
               </svg>
               <span class="ms-3">Dashboard</span>
            </a>
         </li>

         <!-- Perfil -->
         <li>
            <a href="{{ route('profile.edit') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M10 2a5 5 0 1 0 0 10A5 5 0 0 0 10 2ZM3 18a7 7 0 1 1 14 0H3Z"/>
               </svg>
               <span class="ms-3">Perfil</span>
            </a>
         </li>

         <!-- Volver a la tienda -->
         <li>
            <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M10 2a1 1 0 0 0-1 1v6.828l-2.293-2.293a1 1 0 0 0-1.414 1.414L10 13.414V20a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-6.828l2.293 2.293a1 1 0 0 0 1.414-1.414L14 10.586V4a1 1 0 0 0-1-1h-3Z"/>
               </svg>
               <span class="ms-3">Volver a la tienda</span>
            </a>
         </li>

         <!-- Autenticación (Logout) -->
         <li>
            <form method="POST" action="{{ route('logout') }}">
               @csrf
               <button type="submit" class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                  <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                     <path d="M5 3a1 1 0 0 1 1 1v3h8V4a1 1 0 0 1 2 0v3h2V4a3 3 0 0 0-3-3H5a3 3 0 0 0-3 3v3h2V4a1 1 0 0 1 1-1Z"/>
                  </svg>
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
