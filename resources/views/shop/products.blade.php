@extends('layouts.shop')

@section('title', 'Products')

@section('content')

<div class="flex justify-between items-center mb-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-800">
            Our Products
        </h1>

        <p class="text-gray-500 mt-2">
            Browse all available products.
        </p>
    </div>

</div>

<!-- Search & Filter -->

<div class="bg-white rounded-xl shadow p-6 mb-8">

    <form action="{{ route('shop.products') }}" method="GET">

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search products..."
                class="border rounded-lg px-4 py-2">

            <select
                name="category"
                class="border rounded-lg px-4 py-2">

                <option value="">
                    All Categories
                </option>

                @foreach($categories as $category)

                    <option
                        value="{{ $category->id }}"
                        {{ request('category') == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

            
            <button
                class="bg-blue-600 hover:bg-blue-700 text-white rounded-lg">

                Search

            </button>

        </div>

    </form>

</div>

<!-- Product Grid -->

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

@forelse($products as $product)

<div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

    @if($product->image)

        <img
            src="{{ asset('products/'.$product->image) }}"
            class="w-full h-60 object-cover">

    @else

        <div class="h-60 bg-gray-200 flex items-center justify-center">

            No Image

        </div>

    @endif

    <div class="p-5">

        <span class="text-sm text-gray-500">

            {{ $product->category->name }}

        </span>

        <h2 class="text-lg font-bold mt-2">

            {{ $product->name }}

        </h2>

        @if($product->discount_price)

            <div class="mt-3">

                <span class="text-red-600 font-bold text-xl">

                    Rs. {{ number_format($product->discount_price,2) }}

                </span>

                <span class="line-through text-gray-400 ml-2">

                    Rs. {{ number_format($product->price,2) }}

                </span>

            </div>

        @else

            <div class="mt-3 text-xl font-bold text-blue-600">

                Rs. {{ number_format($product->price,2) }}

            </div>

        @endif

        <div class="mt-4">

            @if($product->stock > 0)

                <span class="text-green-600 font-semibold">

                    In Stock

                </span>

            @else

                <span class="text-red-600 font-semibold">

                    Out of Stock

                </span>

            @endif

        </div>

        <a
            href="{{ route('shop.show',$product->id) }}"
            class="mt-5 block bg-blue-600 hover:bg-blue-700 text-center text-white py-2 rounded-lg">

            View Details

        </a>

    </div>

</div>

@empty

<div class="col-span-4">

    <div class="bg-white p-8 rounded-xl shadow text-center">

        No products found.

    </div>

</div>

@endforelse

</div>

<div class="mt-10">

    {{ $products->withQueryString()->links() }}

</div>

@endsection