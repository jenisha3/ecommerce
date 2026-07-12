<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Gadget Store')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-slate-900 shadow-lg">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center h-16">

                <!-- Logo -->
                <a href="{{ route('shop') }}"
                   class="text-2xl font-bold text-white">

                    Gadget Store

                </a>

                <!-- Menu -->
                <div class="flex items-center space-x-6 text-white">

                    <a href="{{ route('shop') }}"
                       class="hover:text-blue-400 transition">
                        Home
                    </a>

                    <a href="{{ route('shop.products') }}"
                       class="hover:text-blue-400 transition">
                        Products
                    </a>

                    <a href="{{ route('shop.categories') }}"
                       class="hover:text-blue-400 transition">
                        Categories
                    </a>

                    @auth

                        <a href="{{ route('cart.index') }}"
                           class="hover:text-blue-400 transition">
                            My Cart
                        </a>

                        <a href="{{ route('orders.index') }}"
                           class="hover:text-blue-400 transition">
                            My Orders
                        </a>

                        <a href="{{ route('dashboard') }}"
                           class="hover:text-blue-400 transition">
                            Dashboard
                        </a>

                        <span class="font-semibold text-yellow-300">

                            {{ auth()->user()->name }}

                        </span>

                        <form action="{{ route('logout') }}" method="POST">

                            @csrf

                            <button
                                type="submit"
                                class="bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg transition">

                                Logout

                            </button>

                        </form>

                    @else

                        <a href="{{ route('login') }}"
                           class="hover:text-blue-400 transition">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                           class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg transition">

                            Register

                        </a>

                    @endauth

                </div>

            </div>

        </div>

    </nav>

    <!-- Page Content -->
    <main class="flex-grow max-w-7xl mx-auto w-full px-6 py-8">

        @if(session('success'))

            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">

                {{ session('success') }}

            </div>

        @endif

        @if(session('error'))

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">

                {{ session('error') }}

            </div>

        @endif

        @yield('content')

    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 text-white mt-auto">

        <div class="max-w-7xl mx-auto py-6 text-center">

            © {{ date('Y') }} Gadget Store. All Rights Reserved.

        </div>

    </footer>

</body>

</html>