@extends('layouts.shop')

@section('title', $product->name)

@section('content')

@if(session('success'))
<div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
    {{ session('error') }}
</div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-10 bg-white rounded-2xl shadow-lg p-8">

    <!-- Product Image -->
    <div>

        @if($product->image)

            <img
                src="{{ asset('products/'.$product->image) }}"
                alt="{{ $product->name }}"
                class="w-full h-[500px] object-cover rounded-xl shadow">

        @else

            <div class="h-[500px] bg-gray-200 rounded-xl flex items-center justify-center text-gray-500 text-xl">

                No Image Available

            </div>

        @endif

    </div>

    <!-- Product Details -->
    <div>

        <p class="text-blue-600 font-semibold uppercase tracking-wide">

            {{ $product->category->name }}

        </p>

        <h1 class="text-4xl font-bold mt-2">

            {{ $product->name }}

        </h1>

        <!-- Rating -->

        <div class="flex items-center mt-4">

            <span class="text-yellow-500 text-xl">

                ★★★★★

            </span>

            <span class="ml-3 text-gray-600">

                {{ number_format($product->averageRating(),1) }}/5

                ({{ $product->totalReviews() }} Reviews)

            </span>

        </div>

        <p class="text-gray-700 mt-6 leading-8">

            {{ $product->description }}

        </p>

        <!-- Price -->

        <div class="mt-8">

            @if($product->discount_price)

                <p class="text-gray-400 text-xl line-through">

                    Rs. {{ number_format($product->price,2) }}

                </p>

                <h2 class="text-4xl font-bold text-red-600">

                    Rs. {{ number_format($product->discount_price,2) }}

                </h2>

            @else

                <h2 class="text-4xl font-bold text-blue-600">

                    Rs. {{ number_format($product->price,2) }}

                </h2>

            @endif

        </div>

        <!-- Stock -->

        <div class="mt-6">

            @if($product->stock > 0)

                <span class="bg-green-100 text-green-700 px-4 py-2 rounded-full">

                    In Stock ({{ $product->stock }})

                </span>

            @else

                <span class="bg-red-100 text-red-700 px-4 py-2 rounded-full">

                    Out of Stock

                </span>

            @endif

        </div>

        <!-- Buttons -->

        <div class="mt-8 space-y-4">

            @if($product->stock > 0)

                <form
                    action="{{ route('cart.store',$product->id) }}"
                    method="POST">

                    @csrf

                    <button
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg text-lg font-semibold transition">

                        🛒 Add to Cart

                    </button>

                </form>

            @endif

            @auth

            <form
                action="{{ route('wishlist.store',$product) }}"
                method="POST">

                @csrf

                <button
                    class="w-full bg-pink-500 hover:bg-pink-600 text-white py-3 rounded-lg text-lg font-semibold transition">

                    ❤️ Add to Wishlist

                </button>

            </form>

            @endauth

        </div>

    </div>

</div>
<!-- Reviews Section -->

<hr class="my-12">

<div class="bg-white rounded-2xl shadow-lg p-8">

    <div class="flex items-center justify-between mb-8">

        <div>

            <h2 class="text-3xl font-bold">

                Customer Reviews

            </h2>

            <p class="text-gray-500 mt-2">

                See what other customers think about this product.

            </p>

        </div>

        <div class="text-right">

            <div class="text-yellow-500 text-3xl">

                ★★★★★

            </div>

            <div class="text-xl font-bold">

                {{ number_format($product->averageRating(),1) }}/5

            </div>

            <div class="text-gray-500">

                {{ $product->totalReviews() }} Reviews

            </div>

        </div>

    </div>

    @auth

    <form action="{{ route('reviews.store',$product) }}"
          method="POST"
          class="border rounded-xl p-6 bg-gray-50">

        @csrf

        <h3 class="text-xl font-semibold mb-5">

            Write Your Review

        </h3>

        <!-- Rating -->

        <div class="mb-6">

            <label class="block font-semibold mb-3">

                Choose Rating

            </label>

            <div class="flex flex-wrap gap-3">

                @foreach([
                    5=>'Excellent',
                    4=>'Very Good',
                    3=>'Good',
                    2=>'Fair',
                    1=>'Poor'
                ] as $value=>$label)

                <label class="cursor-pointer">

                    <input
                        type="radio"
                        name="rating"
                        value="{{ $value }}"
                        class="hidden peer"
                        {{ old('rating') == $value ? 'checked' : '' }}>

                    <div class="w-36 border rounded-xl p-3 text-center
                                transition duration-300
                                hover:border-yellow-500
                                hover:bg-yellow-50
                                peer-checked:border-yellow-500
                                peer-checked:bg-yellow-100">

                        <div class="text-yellow-500 text-xl">

                            {{ str_repeat('★',$value) }}{{ str_repeat('☆',5-$value) }}

                        </div>

                        <div class="font-semibold mt-1">

                            {{ $label }}

                        </div>

                    </div>

                </label>

                @endforeach

            </div>

            @error('rating')

                <p class="text-red-500 mt-2">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <!-- Review -->

        <div class="mb-6">

            <label class="block font-semibold mb-2">

                Review

            </label>

            <textarea
                name="review"
                rows="5"
                class="w-full border rounded-xl p-4 focus:ring-2 focus:ring-blue-500"
                placeholder="Tell other customers about this product...">{{ old('review') }}</textarea>

            @error('review')

                <p class="text-red-500 mt-2">

                    {{ $message }}

                </p>

            @enderror

        </div>

        <button
            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-semibold">

            Submit Review

        </button>

    </form>

    @else

    <div class="bg-yellow-100 border border-yellow-300 rounded-xl p-5">

        Please

        <a href="{{ route('login') }}"
           class="text-blue-600 underline">

            Login

        </a>

        to write a review.

    </div>

    @endauth

    <!-- Display Reviews -->

    <div class="mt-10">

        @forelse($product->reviews as $review)

        <div class="border rounded-xl p-6 mb-5">

            <div class="flex justify-between items-center">

                <div>

                    <h4 class="font-bold text-lg">

                        {{ $review->user->name }}

                    </h4>

                    <p class="text-gray-500 text-sm">

                        {{ $review->created_at->format('d M Y') }}

                    </p>

                </div>

                <div class="text-yellow-500 text-xl">

                    {{ str_repeat('★',$review->rating) }}{{ str_repeat('☆',5-$review->rating) }}

                </div>

            </div>

            <p class="mt-4 text-gray-700 leading-7">

                {{ $review->review }}

            </p>

        </div>

        @empty

        <div class="text-center py-10 text-gray-500">

            No reviews yet.

            Be the first to review this product!

        </div>

        @endforelse

    </div>

</div>
<!-- Related Products -->

@if($relatedProducts->count())

<div class="mt-16">

    <div class="flex items-center justify-between mb-8">

        <h2 class="text-3xl font-bold">

            Related Products

        </h2>

        <a href="{{ route('shop.products') }}"
           class="text-blue-600 hover:underline">

            View All →

        </a>

    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        @foreach($relatedProducts as $item)

        <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden">

            @if($item->image)

            <img
                src="{{ asset('products/'.$item->image) }}"
                alt="{{ $item->name }}"
                class="w-full h-56 object-cover">

            @else

            <div class="w-full h-56 bg-gray-200 flex items-center justify-center">

                No Image

            </div>

            @endif

            <div class="p-5">

                <p class="text-sm text-gray-500">

                    {{ $item->category->name }}

                </p>

                <h3 class="font-bold text-lg mt-2">

                    {{ $item->name }}

                </h3>

                <div class="mt-3">

                    @if($item->discount_price)

                        <span class="text-gray-400 line-through">

                            Rs. {{ number_format($item->price,2) }}

                        </span>

                        <br>

                        <span class="text-red-600 text-xl font-bold">

                            Rs. {{ number_format($item->discount_price,2) }}

                        </span>

                    @else

                        <span class="text-blue-600 text-xl font-bold">

                            Rs. {{ number_format($item->price,2) }}

                        </span>

                    @endif

                </div>

                <div class="mt-5">

                    <a href="{{ route('shop.show',$item) }}"
                       class="block text-center bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-xl font-semibold">

                        View Product

                    </a>

                </div>

            </div>

        </div>

        @endforeach

    </div>

</div>

@endif

@endsection