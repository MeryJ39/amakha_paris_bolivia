<nav class="bg-background p-4" id="headerNav">
    <div class="container mx-auto flex justify-between items-center">
        <!-- Toggler Button for Mobile -->
        <button class="text-text lg:hidden flex items-center space-x-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
            <span class="sr-only">Menu</span>
        </button>

        <!-- Logo -->
        <a href="{{ route('index') }}" class="text-text text-xl font-semibold p-2 ">
            <img src="https://amakha.vtexassets.com/assets/vtex/assets-builder/amakha.store-theme/5.0.10/images/logo___35e1d43974a5d6ba61da815c917cb1fc.png" alt="Amakha Paris Logo" class="h-12    ">
        </a>

        <!-- Search Bar -->
        <div class="hidden lg:flex flex-grow items-center justify-center px-4">
            <input type="text" placeholder="¿Qué producto estás buscando?" class="w-full px-4 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-primary">
            <button class="bg-primary hover:bg-yellow-600 text-white px-4 py-2 rounded-r-md flex items-center">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35m1.65-3.15a7.5 7.5 0 10-7.5 7.5 7.5 7.5 0 007.5-7.5z"></path>
                </svg>
            </button>
        </div>

        <!-- Account and Cart -->
        <div class="hidden lg:flex items-center space-x-4">
            <a class="nav-link mx-2 text-white flex items-center space-x-2" href="{{ route('cart.index') }}">
                <img src="https://amakha.vtexassets.com/assets/vtex/assets-builder/amakha.store-theme/5.0.10/icons/cart___159c0b8138ad35c56bce80457e0564a2.svg">
                @if(Auth::check())
                    <span class="text-text font-bold">{{ \Cart::session(Auth::user())->getTotalQuantity()}}</span>
                @endif
            </a>

            <!-- Authentication Links -->
            <div>
                @if (Route::has('login'))
                <div class="flex space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-text hover:text-primary text-sm">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-text hover:text-primary text-sm">Login</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-text hover:text-primary text-sm">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            </div>

        </div>
    </div>

    <!-- Menu Items -->
    <div class="hidden lg:flex justify-center">
        <div class="container mx-auto flex space-x-8 py-2">
            <div class="relative group">
                <a href="#" class="text-text hover:text-primary">Perfumería</a>
                <div class="hidden group-hover:block absolute bg-gray-100 mt-2 rounded-md shadow-lg">
                    <!-- Dropdown Items -->
                    <a href="#" class="block px-4 py-2 text-sm text-text hover:bg-gray-200">Perfumes</a>
                    <a href="#" class="block px-4 py-2 text-sm text-text hover:bg-gray-200">Fragancias</a>
                </div>
            </div>
            <div class="relative group">



                <a href="#" class="text-text hover:text-primary">Cabello</a>

                <div class="hidden group-hover:block absolute bg-gray-100 mt-2 rounded-md shadow-lg">
                    <!-- Dropdown Items -->
                    <a href="#" class="block px-4 py-2 text-sm text-text hover:bg-gray-200">Shampoos</a>
                    <a href="#" class="block px-4 py-2 text-sm text-text hover:bg-gray-200">Acondicionadores</a>
                </div>

            </div>
            <!-- Repeat for Nutracéuticos, Cuerpo y Baño, Rostro, etc. -->
            <a href="#" class="text-text hover:text-primary">Reventa</a>
            <a href="#" class="text-text hover:text-primary">Promociones</a>
            @if(Auth::check() && Auth::user()->usertype === 'consultant')
    <a href="{{ route('consultant.index') }}" class="text-text hover:text-primary">Consultores </a>
@endif
        </div>
    </div>
</nav>
