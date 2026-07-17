@extends('layouts.shop')

@section('title', 'Customer Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-xl shadow-lg text-white p-8 mb-8">

        <h1 class="text-4xl font-bold">
            Customer Dashboard
        </h1>

        <p class="mt-2 text-lg">
            Welcome,
            <span class="font-semibold">
                {{ auth()->user()->name }}
            </span>
        </p>

        <p class="mt-1 text-blue-100">
            {{ auth()->user()->email }}
        </p>

    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

        <!-- Sidebar -->
        <div class="bg-white rounded-xl shadow-lg p-6">

            <h2 class="text-xl font-bold mb-6 border-b pb-3">
                Customer Menu
            </h2>

            <nav class="space-y-3">

                <a href="{{ route('dashboard') }}"
                   class="block bg-blue-600 hover:bg-blue-700 text-white px-4 py-3 rounded-lg">

                    Dashboard

                </a>

                
                <a href="{{ route('orders.index') }}"
                   class="block hover:bg-gray-100 px-4 py-3 rounded-lg">

                    My Orders

                </a>

                <a href="{{ route('cart.index') }}"
                   class="block hover:bg-gray-100 px-4 py-3 rounded-lg">

                    My Cart

                </a>

                <a href="{{ route('profile.edit') }}"
                    class="block hover:bg-gray-100 px-4 py-3 rounded-lg">
    Edit Profile
</a>

                <form action="{{ route('logout') }}"
                      method="POST">

                    @csrf

                    <button
                        class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg">

                        Logout

                    </button>

                </form>

            </nav>

        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3">

            <!-- Dashboard Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <div class="bg-white rounded-xl shadow-lg p-6">

                    <div class="text-gray-500">
                        Orders
                    </div>

                    <div class="text-4xl font-bold mt-2 text-blue-600">

                        {{ auth()->user()->orders()->count() }}

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">

                    <div class="text-gray-500">
                        Cart Items
                    </div>

                    <div class="text-4xl font-bold mt-2 text-green-600">

                        {{ auth()->user()->carts()->count() }}

                    </div>

                </div>

                <div class="bg-white rounded-xl shadow-lg p-6">

                    <div class="text-gray-500">
                        Account
                    </div>

                    <div class="text-xl font-bold mt-3 text-purple-600">

                        Active

                    </div>

                </div>

            </div>

            <!-- Account Information -->
            <div class="bg-white rounded-xl shadow-lg p-8 mt-8">

                <h2 class="text-2xl font-bold mb-6">
                    Account Information
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <div>

                        <label class="text-gray-500">
                            Full Name
                        </label>

                        <div class="font-semibold text-lg">

                            {{ auth()->user()->name }}

                        </div>

                    </div>

                    <div>

                        <label class="text-gray-500">
                            Email
                        </label>

                        <div class="font-semibold text-lg">

                            {{ auth()->user()->email }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection
