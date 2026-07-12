@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<h2 class="text-3xl font-bold mb-8">
    Dashboard Statistics
</h2>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500">Total Categories</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalCategories }}</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500">Total Products</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalProducts }}</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500">Total Customers</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalCustomers }}</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500">Total Orders</h3>
        <p class="text-3xl font-bold mt-2">{{ $totalOrders }}</p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500">Pending Orders</h3>
        <p class="text-3xl font-bold mt-2 text-yellow-600">
            {{ $pendingOrders }}
        </p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500">Processing Orders</h3>
        <p class="text-3xl font-bold mt-2 text-blue-600">
            {{ $processingOrders }}
        </p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500">Delivered Orders</h3>
        <p class="text-3xl font-bold mt-2 text-green-600">
            {{ $deliveredOrders }}
        </p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500">Cancelled Orders</h3>
        <p class="text-3xl font-bold mt-2 text-red-600">
            {{ $cancelledOrders }}
        </p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500">Revenue</h3>
        <p class="text-2xl font-bold mt-2">
            Rs. {{ number_format($totalRevenue,2) }}
        </p>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h3 class="text-gray-500">Low Stock Products</h3>
        <p class="text-3xl font-bold mt-2 text-orange-600">
            {{ $lowStockProducts }}
        </p>
    </div>

</div>

@endsection