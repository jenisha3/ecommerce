@extends('layouts.shop')

@section('title', 'Shopping Cart')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    Shopping Cart
</h1>

@if(session('success'))

<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
    {{ session('success') }}
</div>

@endif

@if($cartItems->count())

<div class="bg-white rounded-xl shadow overflow-hidden">

<table class="w-full">

    <thead class="bg-gray-100">

    <tr>

        <th class="p-4 text-left">Image</th>

        <th class="p-4 text-left">Product</th>

        <th class="p-4">Price</th>

        <th class="p-4">Quantity</th>

        <th class="p-4">Subtotal</th>

        <th class="p-4">Action</th>

    </tr>

    </thead>

    <tbody>

    @foreach($cartItems as $item)

    <tr class="border-t">

        <td class="p-4">

            @if($item->product->image)

                <img
                    src="{{ asset('products/'.$item->product->image) }}"
                    class="w-20 h-20 object-cover rounded">

            @endif

        </td>

        <td class="p-4">

            <div class="font-semibold">

                {{ $item->product->name }}

            </div>

            <div class="text-gray-500 text-sm">

                {{ $item->product->category->name }}

            </div>

        </td>

        <td class="text-center">

            Rs.
            {{ number_format($item->product->discount_price ?: $item->product->price,2) }}

        </td>

        <td class="text-center">

            <form
                action="{{ route('cart.update',$item->id) }}"
                method="POST">

                @csrf
                @method('PATCH')

                <input
                    type="number"
                    name="quantity"
                    min="1"
                    value="{{ $item->quantity }}"
                    class="border rounded w-20 text-center">

                <button
                    class="bg-blue-600 text-white px-3 py-1 rounded ml-2">

                    Update

                </button>

            </form>

        </td>

        <td class="text-center">

            Rs.
            {{ number_format($item->subtotal,2) }}

        </td>

        <td class="text-center">

            <form
                action="{{ route('cart.destroy',$item->id) }}"
                method="POST">

                @csrf
                @method('DELETE')

                <button
                    onclick="return confirm('Remove item?')"
                    class="bg-red-600 text-white px-4 py-2 rounded">

                    Remove

                </button>

            </form>

        </td>

    </tr>

    @endforeach

    </tbody>

</table>

</div>

<div class="mt-8 flex justify-end">

<div class="bg-white shadow rounded-xl p-6 w-80">

    <h2 class="text-2xl font-bold mb-4">

        Cart Total

    </h2>

    <div class="flex justify-between mb-6">

        <span>Total</span>

        <span class="font-bold">

            Rs. {{ number_format($total,2) }}

        </span>

    </div>

    <a
        href="{{ route('checkout.index') }}"
        class="block text-center bg-green-600 hover:bg-green-700 text-white py-3 rounded-lg">

        Proceed to Checkout

    </a>

</div>

</div>

@else

<div class="bg-white rounded-xl shadow p-10 text-center">

    <h2 class="text-2xl font-bold mb-3">

        Your cart is empty

    </h2>

    <a
        href="{{ route('shop.products') }}"
        class="inline-block mt-4 bg-blue-600 text-white px-6 py-3 rounded-lg">

        Continue Shopping

    </a>

</div>

@endif

@endsection