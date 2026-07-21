<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title','Gadget Store')</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

</head>

<body class="bg-gray-100 min-h-screen flex flex-col">

<!--  NAVBAR  -->

<nav class="bg-slate-900 shadow-lg">

    <div class="max-w-7xl mx-auto px-6">

        <div class="flex justify-between items-center h-16">

            <!-- Logo -->

            <a href="{{ route('shop') }}"
               class="text-2xl font-bold text-white">

                Gadget Store

            </a>

            <!-- Menu -->

            <div class="flex items-center gap-8 text-white">

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

                <a href="{{ route('wishlist.index') }}"
                   class="hover:text-pink-400 transition">

                 Wishlist

                </a>

                @else

                <a href="{{ route('login') }}"
                   class="hover:text-blue-400">

                    Login

                </a>

                <a href="{{ route('register') }}"
                   class="bg-blue-600 px-4 py-2 rounded-lg hover:bg-blue-700">

                    Register

                </a>

                @endauth

            </div>

        </div>

    </div>

</nav>

<!-- PAGE -->

<div class="flex flex-1">

@auth

<!--  SIDEBAR  -->

<aside class="w-64 bg-white shadow-lg min-h-screen">

    <div class="p-6 text-center border-b">

        <div class="w-20 h-20 rounded-full bg-blue-600 text-white flex items-center justify-center text-3xl font-bold mx-auto">

            {{ strtoupper(substr(auth()->user()->name,0,1)) }}

        </div>

        <h2 class="mt-4 font-bold text-xl">

            {{ auth()->user()->name }}

        </h2>

        <p class="text-gray-500 text-sm">

            {{ auth()->user()->email }}

        </p>

    </div>

    <nav class="mt-6">

        <a href="{{ route('dashboard') }}"
           class="flex items-center px-6 py-4 hover:bg-blue-50">

            📊
            <span class="ml-3">

                Dashboard

            </span>

        </a>

        <a href="{{ route('orders.index') }}"
           class="flex items-center px-6 py-4 hover:bg-blue-50">

            📦
            <span class="ml-3">

                My Orders

            </span>

        </a>

        <a href="{{ route('wishlist.index') }}"
           class="flex items-center px-6 py-4 hover:bg-pink-50">

            ❤️
            <span class="ml-3">

                Wishlist

            </span>

        </a>

        <a href="{{ route('profile.edit') }}"
           class="flex items-center px-6 py-4 hover:bg-blue-50">

            👤
            <span class="ml-3">

                Edit Profile

            </span>

        </a>

        <form action="{{ route('logout') }}"
              method="POST">

            @csrf

            <button
                class="w-full text-left px-6 py-4 hover:bg-red-100 text-red-600">

                🚪
                <span class="ml-3">

                    Logout

                </span>

            </button>

        </form>

    </nav>

</aside>

@endif

<!--  CONTENT  -->

<div class="flex-1 p-8">

@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg mb-6">

    {{ session('success') }}

</div>

@endif

@if(session('error'))

<div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-6">

    {{ session('error') }}

</div>

@endif

@yield('content')