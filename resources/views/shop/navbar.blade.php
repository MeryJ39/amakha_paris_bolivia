<!-- resources/views/shop/navbar.blade.php -->
<header class="bg-gray-900 text-white shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-semibold">Laravel Store</a>
        <nav>
            <ul class="flex space-x-6">
                <li><a href="/" class="hover:text-gray-300">Home</a></li>
                <li><a href="/shop" class="hover:text-gray-300">Shop</a></li>
                <li><a href="/about" class="hover:text-gray-300">About</a></li>
                <li><a href="/contact" class="hover:text-gray-300">Contact</a></li>

                @if (Route::has('login'))
                    <li>
                        @auth
                            <a href="{{ url('/dashboard') }}" class="hover:text-gray-300">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="hover:text-gray-300">Log in</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="hover:text-gray-300">Register</a>
                            @endif
                        @endauth
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>

