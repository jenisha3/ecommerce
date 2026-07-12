@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-3xl font-bold text-gray-800">
                Orders
            </h2>

            <p class="text-gray-500 mt-1">
                Manage customer orders.
            </p>

        </div>

    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @endif

    <!-- Search -->

    <div class="bg-white shadow rounded-xl p-5 mb-6">

        <form method="GET" action="{{ route('admin.orders.index') }}">

            <div class="grid md:grid-cols-3 gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search customer..."
                    class="border rounded-lg px-4 py-2">

                <select
                    name="status"
                    class="border rounded-lg px-4 py-2">

                    <option value="">All Status</option>

                    <option value="Pending"
                        {{ request('status')=='Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Processing"
                        {{ request('status')=='Processing' ? 'selected' : '' }}>
                        Processing
                    </option>

                    <option value="Shipped"
                        {{ request('status')=='Shipped' ? 'selected' : '' }}>
                        Shipped
                    </option>

                    <option value="Delivered"
                        {{ request('status')=='Delivered' ? 'selected' : '' }}>
                        Delivered
                    </option>

                    <option value="Cancelled"
                        {{ request('status')=='Cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>

                </select>

                <div class="flex gap-2">

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                        Search

                    </button>

                    <a href="{{ route('admin.orders.index') }}"
                       class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

    <!-- Orders Table -->

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-900 text-white">

            <tr>

                <th class="px-5 py-4 text-left">Order #</th>

                <th class="px-5 py-4 text-left">Customer</th>

                <th class="px-5 py-4 text-left">Amount</th>

                <th class="px-5 py-4 text-left">Status</th>

                <th class="px-5 py-4 text-center">Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($orders as $order)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-5 py-4">
                        #{{ $order->id }}
                    </td>

                    <td class="px-5 py-4">
                        {{ $order->user->name }}
                    </td>

                    <td class="px-5 py-4">
                        Rs. {{ number_format($order->total_amount,2) }}
                    </td>

                    <td class="px-5 py-4">

                        @if($order->status=='Pending')

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                Pending
                            </span>

                        @elseif($order->status=='Processing')

                            <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
                                Processing
                            </span>

                        @elseif($order->status=='Shipped')

                            <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-sm">
                                Shipped
                            </span>

                        @elseif($order->status=='Delivered')

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                Delivered
                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                Cancelled
                            </span>

                        @endif

                    </td>

                    <td class="px-5 py-4 text-center">

                        <a href="{{ route('admin.orders.show',$order->id) }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                            View

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5"
                        class="text-center py-8">

                        No Orders Found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $orders->withQueryString()->links() }}

    </div>

</div>

@endsection