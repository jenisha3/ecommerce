@extends('layouts.shop')

@section('title',$category->name)

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="bg-gradient-to-r from-indigo-700 to-blue-700 rounded-xl text-white p-10 mb-10">

        <h1 class="text-4xl font-bold">

            {{ $category->name }}

        </h1>

        <p class="mt-2">

            {{ $products->total() }} Products Available

        </p>

    </div>

    @if($products->count())

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">

        @foreach($products as $product)

        <div class="bg-white rounded-xl shadow-lg overflow-hidden">

            @if($product->image)

            <img src="{{ asset('products/'.$product->image) }}"
                 class="w-full h-56 object-cover">

            @endif

            <div class="p-5">

                <h2 class="text-xl font-bold">

                    {{ $product->name }}

                </h2>

                <p class="text-blue-600 font-bold mt-3">

                    Rs.
                    {{ number_format($product->discount_price ?: $product->price,2) }}

                </p>

                <a href="{{ route('shop.show',$product) }}"
                   class="block text-center bg-blue-600 hover:bg-blue-700 text-white rounded-lg py-3 mt-5">

                    View Product

                </a>

            </div>

        </div>

        @endforeach

    </div>

    <div class="mt-10">

        {{ $products->links() }}

    </div>

    @else

        <div class="bg-white rounded-xl shadow-lg p-10 text-center">

            <h2 class="text-2xl font-bold">

                No Products Found

            </h2>

        </div>

    @endif

</div>

@endsection