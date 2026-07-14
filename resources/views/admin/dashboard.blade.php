@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="mx-auto max-w-7xl space-y-8">

    <section class="flex flex-col justify-between gap-5 border-b border-slate-200 pb-8 sm:flex-row sm:items-end">
        <div>
            <p class="text-sm font-semibold uppercase tracking-widest text-blue-600">Store overview</p>
            <h2 class="mt-2 text-3xl font-bold text-slate-900">Good to see you, {{ auth()->user()->name }}</h2>
            <p class="mt-2 text-slate-500">Here is a live snapshot of your store operations.</p>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center justify-center rounded-lg bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-700">
            View all orders
        </a>
    </section>

    <div class="grid gap-5 sm:grid-cols-2 xl:grid-cols-4">

        <a href="{{ route('admin.categories.index') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">
            <h3 class="text-sm font-medium text-slate-500">Total Categories</h3>
            <p class="mt-3 text-3xl font-bold text-slate-900">{{ number_format($totalCategories) }}</p>
            <p class="mt-5 text-sm font-medium text-blue-600">Organize catalog</p>
        </a>

        <a href="{{ route('admin.products.index') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">
            <h3 class="text-sm font-medium text-slate-500">Total Products</h3>
            <p class="mt-3 text-3xl font-bold text-slate-900">{{ number_format($totalProducts) }}</p>
            <p class="mt-5 text-sm font-medium text-blue-600">Browse catalog</p>
        </a>

        <a href="{{ route('admin.customers.index') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">
            <h3 class="text-sm font-medium text-slate-500">Total Customers</h3>
            <p class="mt-3 text-3xl font-bold text-slate-900">{{ number_format($totalCustomers) }}</p>
            <p class="mt-5 text-sm font-medium text-blue-600">Manage customers</p>
        </a>

        <a href="{{ route('admin.orders.index') }}" class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md">
            <h3 class="text-sm font-medium text-slate-500">Total Orders</h3>
            <p class="mt-3 text-3xl font-bold text-slate-900">{{ number_format($totalOrders) }}</p>
            <p class="mt-5 text-sm font-medium text-blue-600">Review orders</p>
        </a>

    </div>

    <section class="grid gap-6 xl:grid-cols-5">
        <div class="rounded-lg border border-slate-200 bg-white p-6 shadow-sm xl:col-span-3">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900">Order fulfillment</h3>
                    <p class="mt-1 text-sm text-slate-500">Current order status across the store.</p>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-blue-600 hover:text-blue-700">View orders</a>
            </div>

            <div class="mt-6 grid grid-cols-2 gap-4 lg:grid-cols-4">

                <div class="rounded-lg bg-amber-50 p-4">
                    <p class="text-sm font-medium text-amber-700">Pending</p>
                    <p class="mt-3 text-3xl font-bold text-amber-900">{{ number_format($pendingOrders) }}</p>
                </div>
                <div class="rounded-lg bg-blue-50 p-4">
                    <p class="text-sm font-medium text-blue-700">Processing</p>
                    <p class="mt-3 text-3xl font-bold text-blue-900">{{ number_format($processingOrders) }}</p>
                </div>
                <div class="rounded-lg bg-emerald-50 p-4">
                    <p class="text-sm font-medium text-emerald-700">Delivered</p>
                    <p class="mt-3 text-3xl font-bold text-emerald-900">{{ number_format($deliveredOrders) }}</p>
                </div>
                <div class="rounded-lg bg-rose-50 p-4">
                    <p class="text-sm font-medium text-rose-700">Cancelled</p>
                    <p class="mt-3 text-3xl font-bold text-rose-900">{{ number_format($cancelledOrders) }}</p>
                </div>
            </div>
        </div>

        <div class="rounded-lg bg-slate-900 p-6 text-white shadow-sm xl:col-span-2">
            <p class="text-sm font-semibold uppercase tracking-widest text-slate-400">Needs attention</p>
            <h3 class="mt-3 text-2xl font-bold">Inventory check</h3>
            <p class="mt-2 text-sm leading-6 text-slate-300">Review products that are running low before they affect your sales.</p>
            <div class="mt-7 flex items-end justify-between border-t border-slate-700 pt-5">
                <div>
                    <p class="text-4xl font-bold">{{ number_format($lowStockProducts) }}</p>
                    <p class="mt-1 text-sm text-slate-400">low stock products</p>
                </div>
                <a href="{{ route('admin.inventory.index') }}" class="rounded-lg bg-white px-4 py-2 text-sm font-semibold text-slate-900 transition hover:bg-slate-100">Review inventory</a>
            </div>
        </div>
    </section>

    <section class="rounded-lg border border-emerald-200 bg-emerald-50 px-6 py-5">
        <p class="text-sm font-semibold text-emerald-800">Store health</p>
        <p class="mt-1 text-sm text-emerald-700">You have {{ number_format($totalOrders) }} total orders and {{ number_format($deliveredOrders) }} delivered orders in your store.</p>
    </section>

</div>

@endsection
