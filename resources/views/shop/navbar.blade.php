<nav class="bg-gray-50 border-b border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img src="https://amakha.vtexassets.com/assets/vtex/assets-builder/amakha.store-theme/5.0.10/images/logo___35e1d43974a5d6ba61da815c917cb1fc.png" alt="Logo" class="h-12" />
        </a>

        <!-- Search Input (Desktop) -->
        <div class="relative hidden md:block flex-grow mx-4">
            <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
            </div>
            <input type="text" id="search-navbar" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary" placeholder="Buscar...">
        </div>

        <!-- Mobile Toggle Buttons -->
        <div class="flex md:order-2">
            <button type="button" class="md:hidden text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5 me-1" onclick="document.getElementById('navbar-search').classList.toggle('hidden');">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Search</span>
            </button>
            <button type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" onclick="document.getElementById('navbar-search').classList.toggle('hidden');">
                <span class="sr-only">Open main menu</span>
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                </svg>
            </button>
        </div>

        <!-- Search and Menu (Mobile) -->
        <div class="hidden w-full md:flex md:order-1" id="navbar-search">
            <div class="relative mt-3 md:hidden">
                <div class="absolute inset-y-0 left-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="text" id="search-navbar-mobile" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary" placeholder="Buscar...">
            </div>

            <!-- Menu Items -->
            <ul class="flex flex-col lg:text-center md:flex-row md:justify-center md:items-center p-4 md:p-0 mt-2 font-normal text-sm bg-gray-50 dark:bg-gray-800 w-full">

                <!-- Enlaces inventados (sin categorías) -->
                <li class="w-max">
                    <a href="#" class="block py-2 px-3 hover:text-primary">Inicio</a>
                </li>

                <li class="w-max">
                    <a href="#" class="block py-2 px-3 hover:text-primary">Productos</a>
                </li>

                <li class="w-max">
                    <a href="#" class="block py-2 px-3 hover:text-primary">Ofertas</a>
                </li>

                <li class="w-max">
                    <a href="#" class="block py-2 px-3 hover:text-primary">Sobre nosotros</a>
                </li>



                <!-- Enlace a la cuenta del usuario -->
                <li class="w-max">
                    <a href="{{ auth()->check() ? url('/dashboard') : route('login') }}" class="flex items-center">
                        <button class="bg-primary hover:bg-background p-2 rounded-lg flex items-center">
                            <i class="fa-regular fa-user mr-2"></i>
                            <div class="flex flex-col text-left">
                                <span class="text-sm font-light truncate">{{ auth()->check() ? 'Mi Perfil' : 'MI CUENTA' }}</span>
                                <small class="text-xs font-light text-gray-700 truncate">{{ auth()->check() ? 'mis pedidos' : 'LogIn or SignUp' }}</small>
                            </div>
                        </button>
                    </a>
                </li>





                <div>
                    <!-- drawer init and toggle -->
                    <li class="w-max">
                        <a href="#"
                           class="relative flex lg:justify-center py-2 px-3 text-gray-900 hover:bg-gray-100 rounded md:hover:bg-transparent md:hover:text-primary dark:text-white dark:hover:bg-gray-700 dark:hover:text-white"
                           data-drawer-target="drawer-right-example"
                           data-drawer-show="drawer-right-example"
                           data-drawer-placement="right"
                           aria-controls="drawer-right-example">
                            <!-- Icono del carrito -->
                            <img src="https://amakha.vtexassets.com/assets/vtex/assets-builder/amakha.store-theme/5.0.10/icons/cart___159c0b8138ad35c56bce80457e0564a2.svg" alt="Cart" class="">

                            <!-- Número de productos en carrito con estilo de círculo -->

                                <livewire:cart-count />


                        </a>
                    </li>



                <!-- drawer component -->
                <div id="drawer-right-example" class="fixed top-0 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform translate-x-full bg-white w-96 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-right-label">
                    <!-- Header (title) of the drawer -->
                    <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                        <svg class="w-4 h-4 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        Carrito de compras
                    </h5>

                    <!-- Close button -->
                    <button type="button" data-drawer-hide="drawer-right-example" aria-controls="drawer-right-example" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 right-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close menu</span>
                    </button>

                    <livewire:cart-component />

                    @if(auth()->check())
                    <button type="button"
                            class=" w-full mt-3 text-black bg-primary hover:bg-secondary hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 inline-flex items-center me-2"
                            onclick="window.location.href='{{ route('checkout') }}';">
                        <!-- Icono de carrito de compras (opcional) -->
                        <svg class="w-3.5 h-3.5 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                            <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                        </svg>
                        Ir a Pagar
                    </button>
                    @endif



                </div>

            </div>






            </ul>
        </div>
    </div>
</nav>
