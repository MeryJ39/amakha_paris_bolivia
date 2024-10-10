<nav class="bg-gray-50 border-b border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo -->
        <a href="{{ route('index') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
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
            <div id="search-results" class="absolute left-0 z-10 w-full bg-white border border-gray-300 hidden">
                <div id="loading" class="hidden text-center py-2">
                    <svg class="animate-spin h-5 w-5 mr-3 inline-block" viewBox="0 0 24 24">
                        <circle class="text-gray-200" cx="12" cy="12" r="10" stroke-width="4" />
                        <path class="text-gray-500" fill="currentColor" d="M12 2a10 10 0 1 0 0 20 10 10 0 0 0 0-20z" />
                    </svg>
                    Processing...
                </div>
                <ul id="results-list" class="max-h-60 overflow-y-auto"></ul>
            </div>
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
                <div id="search-results-mobile" class="absolute left-0 z-10 w-full bg-white border border-gray-300 hidden">
                    <ul id="results-list-mobile" class="max-h-60 overflow-y-auto"></ul>
                </div>
            </div>

            <!-- Menu Items -->
            <ul class="flex flex-col lg:text-center md:flex-row md:justify-center md:items-center p-4 md:p-0 mt-2 font-normal text-sm bg-gray-50 dark:bg-gray-800 w-full">

                @foreach($categories as $category)
            <li class="w-max relative">
                <button id="dropdown{{ $category->id }}" data-dropdown-toggle="dropdownMenu{{ $category->id }}" class=" w-full py-2 px-3 hover:text-primary flex justify-between items-center">
                    {{ $category->name }}
                    <svg class="w-2.5 h-2.5 ml-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownMenu{{ $category->id }}" class="hidden absolute left-0 mt-2 w-48 bg-white rounded-lg shadow-lg z-10">
                    <ul class="py-2 text-sm text-gray-700" aria-labelledby="dropdown{{ $category->id }}">
                        @foreach($category->subcategories as $subcategory)
                            <li>
                                <a href="#" class="block px-4 py-2 hover:bg-gray-100">{{ $subcategory->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </li>
        @endforeach


                @if(Auth::check() && Auth::user()->usertype === 'consultant')
                    <li class="w-max relative"><a href="{{ route('consultant.index') }}" class="block py-2 px-3 hover:text-primary">Consultores</a></li>
                @endif

                <li class="w-max">
                    <a href="{{ auth()->check() ? url('/dashboard') : route('login') }}" class="flex items-center">
                        <button class="bg-primary hover:bg-background  p-2 rounded-lg flex items-center">
                            <i class="fa-regular fa-user mr-2"></i>
                            <div class="flex flex-col text-left">
                                <span class="text-sm font-light  truncate">{{ auth()->check() ? 'Mi Perfil' : 'MI CUENTA' }}</span>
                                <small class="text-xs font-light text-gray-700   truncate">{{ auth()->check() ? '' : 'LogIn or SignUp' }}</small>
                            </div>
                        </button>
                    </a>
                </li>













                <li class="w-max  ">
                    <a href="{{ route('cart.index') }}" class="flex lg:justify-center py-2 px-3 text-gray-900 hover:bg-gray-100 rounded md:hover:bg-transparent md:hover:text-primary dark:text-white dark:hover:bg-gray-700 dark:hover:text-white">
                        <img src="https://amakha.vtexassets.com/assets/vtex/assets-builder/amakha.store-theme/5.0.10/icons/cart___159c0b8138ad35c56bce80457e0564a2.svg" alt="Cart" class="mx-2">
                        @if(Auth::check())
                            <span class="font-bold">{{ \Cart::session(Auth::user())->getTotalQuantity() }}</span>
                        @endif
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
