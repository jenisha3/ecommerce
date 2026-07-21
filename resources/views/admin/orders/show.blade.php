@extends('layouts.admin')

@section('title', 'Order Details')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-3xl font-bold text-gray-800">
                Order #{{ $order->id }}
            </h2>

            <p class="text-gray-500 mt-1">
                Customer Order Details
            </p>

        </div>

        <a href="{{ route('admin.orders.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">

            Back

        </a>

    </div>

    
    <!-- Customer Information -->

    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <h3 class="text-xl font-semibold mb-5">
            Customer Information
        </h3>

        <div class="grid grid-cols-2 gap-6">

            <div>

                <p class="text-gray-500">Customer Name</p>

                <p class="font-semibold">
                    {{ $order->customer_name }}
                </p>

            </div>

            <div>

                <p class="text-gray-500">Email</p>

                <p class="font-semibold">
                    {{ $order->email }}
                </p>

            </div>
            <div>

    <p class="text-gray-500">
        Phone
    </p>

    <p class="font-semibold">
        {{ $order->phone }}
    </p>

</div>

<div>

    <p class="text-gray-500">
        Shipping Address
    </p>

    <p class="font-semibold">
        {{ $order->shipping_address }}
    </p>

</div>

            <div>

                <p class="text-gray-500">Order Date</p>

                <p class="font-semibold">
                    {{ $order->created_at->format('d M Y h:i A') }}
                </p>

            </div>

            <div>

                <p class="text-gray-500">Total Amount</p>

                <p class="font-bold text-blue-600 text-lg">
                    Rs. {{ number_format($order->total_amount,2) }}
                </p>

            </div>

        </div>

    </div>

    <!-- Order Status -->

    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <h3 class="text-xl font-semibold mb-5">
            Update Order Status
        </h3>

        <form action="{{ route('admin.orders.update',$order->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="flex gap-4 items-center">

                <select
                    name="status"
                    class="border rounded-lg px-4 py-2 w-60">

                    <option value="Pending"
                        {{ $order->status=='Pending' ? 'selected' : '' }}>
                        Pending
                    </option>

                    <option value="Processing"
                        {{ $order->status=='Processing' ? 'selected' : '' }}>
                        Processing
                    </option>

                    <option value="Shipped"
                        {{ $order->status=='Shipped' ? 'selected' : '' }}>
                        Shipped
                    </option>

                    <option value="Delivered"
                        {{ $order->status=='Delivered' ? 'selected' : '' }}>
                        Delivered
                    </option>

                    <option value="Cancelled"
                        {{ $order->status=='Cancelled' ? 'selected' : '' }}>
                        Cancelled
                    </option>

                </select>

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">

                    Update Status

                </button>

            </div>

        </form>

    </div>

    <!-- Order Items -->

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <div class="px-6 py-4 border-b">

            <h3 class="text-xl font-semibold">
                Ordered Products
            </h3>

        </div>

        <table class="w-full">

            <thead class="bg-slate-900 text-white">

            <tr>

                <th class="text-left px-6 py-4">
                    Product
                </th>

                <th class="text-left px-6 py-4">
                    Price
                </th>

                <th class="text-left px-6 py-4">
                    Quantity
                </th>

                <th class="text-left px-6 py-4">
                    Subtotal
                </th>

            </tr>

            </thead>

            <tbody>

            @foreach($order->items as $item)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-6 py-4">

                        {{ $item->product->name }}

                    </td>

                    <td class="px-6 py-4">

                        Rs. {{ number_format($item->price,2) }}

                    </td>

                    <td class="px-6 py-4">

                        {{ $item->quantity }}

                    </td>

                    <td class="px-6 py-4 font-semibold">

                        Rs. {{ number_format($item->price * $item->quantity,2) }}

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection