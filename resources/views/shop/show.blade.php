@extends('layouts.shop')

@section('title', $product->name)

@section('content')

@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
    {{ session('error') }}
</div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-10 bg-white shadow rounded-xl p-8">

    <div>
        @if($product->image)
            <img src="{{ asset('products/'.$product->image) }}"
                 class="w-full rounded-lg shadow">
        @else
            <div class="h-96 flex items-center justify-center bg-gray-200 rounded-lg">
                No Image
            </div>
        @endif
    </div>

    <div>

        <h1 class="text-4xl font-bold mb-4">
            {{ $product->name }}
        </h1>

        <p class="text-gray-600 mb-4">
            {{ $product->category->name }}
        </p>

        <p class="text-gray-700 mb-6">
            {{ $product->description }}
        </p>

        @if($product->discount_price)

            <p class="text-gray-400 line-through text-xl">
                Rs. {{ number_format($product->price,2) }}
            </p>

            <p class="text-3xl text-red-600 font-bold mb-4">
                Rs. {{ number_format($product->discount_price,2) }}
            </p>

        @else

            <p class="text-3xl text-blue-600 font-bold mb-4">
                Rs. {{ number_format($product->price,2) }}
            </p>

        @endif

        <p class="mb-6">
            Stock :
            <strong>{{ $product->stock }}</strong>
        </p>

        @if($product->stock > 0)

            <form action="{{ route('cart.store',$product->id) }}" method="POST">

                @csrf

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg">

                    Add to Cart

                </button>

            </form>

        @else

            <button disabled
                    class="bg-gray-400 text-white px-8 py-3 rounded-lg">

                Out of Stock

            </button>

        @endif

    </div>

</div>

@if($relatedProducts->count())

<h2 class="text-3xl font-bold mt-12 mb-6">
    Related Products
</h2>

<div class="grid grid-cols-1 md:grid-cols-4 gap-6">

@foreach($relatedProducts as $item)

<div class="bg-white rounded-xl shadow overflow-hidden">

    @if($item->image)

        <img src="{{ asset('products/'.$item->image) }}"
             class="w-full h-56 object-cover">

    @endif

    <div class="p-5">

        <h3 class="font-bold">
            {{ $item->name }}
        </h3>

        <p class="text-blue-600 font-bold mt-2">

            Rs.

            {{ number_format($item->discount_price ?: $item->price,2) }}

        </p>

        <a href="{{ route('shop.show',$item->id) }}"
           class="block text-center bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-2 mt-4">

            View Product

        </a>

    </div>

</div>

@endforeach

</div>

@endif

@endsection