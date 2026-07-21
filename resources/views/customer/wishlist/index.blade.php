@extends('layouts.shop')

@section('title','My Wishlist')

@section('content')

<h1 class="text-3xl font-bold mb-8">
    ❤️ My Wishlist
</h1>

@if(session('success'))

<div class="bg-green-100 text-green-700 p-4 rounded mb-6">
    {{ session('success') }}
</div>

@endif

@if($wishlists->count())

<div class="grid md:grid-cols-4 gap-6">

@foreach($wishlists as $wishlist)

<div class="bg-white rounded-xl shadow overflow-hidden">

    @if($wishlist->product->image)

    <img
        src="{{ asset('products/'.$wishlist->product->image) }}"
        class="w-full h-52 object-cover">

    @endif

    <div class="p-5">

        <h2 class="font-bold">

            {{ $wishlist->product->name }}

        </h2>

        <p class="text-blue-600 font-bold mt-2">

            Rs.
            {{ number_format($wishlist->product->discount_price ?: $wishlist->product->price,2) }}

        </p>

        <a
            href="{{ route('shop.show',$wishlist->product) }}"
            class="block text-center bg-blue-600 text-white rounded py-2 mt-4">

            View Product

        </a>

        <form
            action="{{ route('wishlist.destroy',$wishlist) }}"
            method="POST"
            class="mt-3">

            @csrf
            @method('DELETE')

            <button
                class="w-full bg-red-600 text-white rounded py-2">

                Remove

            </button>

        </form>

    </div>

</div>

@endforeach

</div>

@else

<div class="bg-gray-100 p-8 rounded text-center">

    Your wishlist is empty.

</div>

@endif

@endsection