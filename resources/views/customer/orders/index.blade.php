@extends('layouts.shop')

@section('title', 'My Orders')

@section('content')

<div class="max-w-7xl mx-auto">

    <!-- Header -->
    <div class="bg-gradient-to-r from-indigo-600 to-blue-700 rounded-xl shadow-lg text-white p-8 mb-8">

        <h1 class="text-4xl font-bold">
            My Orders
        </h1>

        <p class="mt-2 text-lg">
            Welcome,
            <span class="font-semibold">
                {{ auth()->user()->name }}
            </span>
        </p>

    </div>

    <!-- Navigation -->
    <div class="bg-white rounded-xl shadow-lg p-5 mb-8">

        <div class="flex flex-wrap gap-4">

            <a href="{{ route('dashboard') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Customer Dashboard

            </a>

            <a href="{{ route('shop') }}"
               class="bg-gray-100 hover:bg-gray-200 px-5 py-2 rounded-lg">

                Shop

            </a>

            <a href="{{ route('cart.index') }}"
               class="bg-gray-100 hover:bg-gray-200 px-5 py-2 rounded-lg">

                My Cart

            </a>

        </div>

    </div>

    <!-- Orders Table -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">

        <div class="p-6 border-b">

            <h2 class="text-2xl font-bold">
                Order History
            </h2>

        </div>

        <div class="overflow-x-auto">

            <table class="min-w-full">

                <thead class="bg-gray-100">

                <tr>

                    <th class="px-6 py-4 text-left font-semibold">
                        Order ID
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Total Amount
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Payment Method
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Status
                    </th>

                    <th class="px-6 py-4 text-left font-semibold">
                        Order Date
                    </th>

                    <th class="px-6 py-4 text-center font-semibold">
                        Action
                    </th>

                </tr>

                </thead>

                <tbody>

                @forelse($orders as $order)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="px-6 py-4 font-semibold">

                            #{{ $order->id }}

                        </td>

                        <td class="px-6 py-4">

                            Rs. {{ number_format($order->total_amount,2) }}

                        </td>

                        <td class="px-6 py-4">

                            {{ $order->payment_method }}

                        </td>

                        <td class="px-6 py-4">

                            @if($order->status=='Pending')

                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                    Pending

                                </span>

                            @elseif($order->status=='Processing')

                                <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">

                                    Processing

                                </span>

                            @elseif($order->status=='Delivered')

                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                    Delivered

                                </span>

                            @elseif($order->status=='Cancelled')

                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                    Cancelled

                                </span>

                            @else

                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">

                                    {{ $order->status }}

                                </span>

                            @endif

                        </td>

                        <td class="px-6 py-4">

                            {{ $order->created_at->format('d M Y') }}

                        </td>

                        <td class="px-6 py-4 text-center">

                            <a href="{{ route('orders.show',$order->id) }}"
                               class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg">

                                View Details

                            </a>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="6" class="text-center py-10 text-gray-500">

                            You haven't placed any orders yet.

                        </td>

                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

@endsection