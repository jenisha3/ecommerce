@extends('layouts.shop')

@section('title', 'Customer Dashboard')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Welcome Card -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-2xl shadow-lg p-8 text-white mb-8">

        <h1 class="text-4xl font-bold">
            Welcome back, {{ auth()->user()->name }} 👋
        </h1>

        <p class="mt-3 text-blue-100">
            Manage your orders, wishlist, cart and account information from your dashboard.
        </p>

    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

        <!-- Orders -->
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500">
                        Total Orders
                    </p>

                    <h2 class="text-4xl font-bold text-blue-600 mt-2">

                        {{ auth()->user()->orders()->count() }}

                    </h2>

                </div>

                <div class="text-5xl">
                    📦
                </div>

            </div>

        </div>

        <!-- Cart -->
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500">
                        Cart Items
                    </p>

                    <h2 class="text-4xl font-bold text-green-600 mt-2">

                        {{ auth()->user()->carts()->count() }}

                    </h2>

                </div>

                <div class="text-5xl">
                    🛒
                </div>

            </div>

        </div>

        <!-- Account -->
        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition p-6">

            <div class="flex justify-between items-center">

                <div>

                    <p class="text-gray-500">
                        Account Status
                    </p>

                    <h2 class="text-2xl font-bold text-purple-600 mt-2">

                        Active

                    </h2>

                </div>

                <div class="text-5xl">
                    👤
                </div>

            </div>

        </div>

    </div>

    <!-- Account Information -->
    <div class="bg-white rounded-2xl shadow-lg p-8">

        <div class="flex justify-between items-center mb-6">

            <h2 class="text-2xl font-bold">

                Account Information

            </h2>

            <a href="{{ route('profile.edit') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Edit Profile

            </a>

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div>

                <label class="text-gray-500 text-sm">
                    Full Name
                </label>

                <div class="mt-2 p-4 rounded-lg bg-gray-50 font-semibold text-lg">

                    {{ auth()->user()->name }}

                </div>

            </div>

            <div>

                <label class="text-gray-500 text-sm">
                    Email Address
                </label>

                <div class="mt-2 p-4 rounded-lg bg-gray-50 font-semibold text-lg">

                    {{ auth()->user()->email }}

                </div>

            </div>

            <div>

                <label class="text-gray-500 text-sm">
                    Phone Number
                </label>

                <div class="mt-2 p-4 rounded-lg bg-gray-50">

                    {{ auth()->user()->phone ?? 'Not Added' }}

                </div>

            </div>

            <div>

                <label class="text-gray-500 text-sm">
                    Address
                </label>

                <div class="mt-2 p-4 rounded-lg bg-gray-50">

                    {{ auth()->user()->address ?? 'Not Added' }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection