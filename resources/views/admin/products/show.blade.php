@extends('layouts.admin')

@section('title', 'Product Details')

@section('content')

<div class="max-w-6xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Product Details
            </h2>

            <p class="text-gray-500">
                View product information.
            </p>
        </div>

        <div class="flex gap-3">

            <a href="{{ route('admin.products.edit',$product->id) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-white px-5 py-2 rounded-lg">
                Edit
            </a>

            <a href="{{ route('admin.products.index') }}"
               class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
                Back
            </a>

        </div>

    </div>

    <div class="bg-white shadow-lg rounded-xl p-8">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div>

                @if($product->image)

                    <img
                        src="{{ asset('products/'.$product->image) }}"
                        class="w-full rounded-lg border">

                @else

                    <div class="h-80 flex items-center justify-center bg-gray-100 rounded-lg">

                        No Image

                    </div>

                @endif

            </div>

            <div class="space-y-5">

                <div>
                    <strong>Name:</strong>
                    {{ $product->name }}
                </div>

                <div>
                    <strong>Category:</strong>
                    {{ $product->category->name }}
                </div>

                <div>
                    <strong>Price:</strong>
                    Rs. {{ number_format($product->price,2) }}
                </div>

                <div>
                    <strong>Discount Price:</strong>

                    @if($product->discount_price)

                        Rs. {{ number_format($product->discount_price,2) }}

                    @else

                        -

                    @endif

                </div>

                <div>

                    <strong>Stock:</strong>

                    {{ $product->stock }}

                </div>

                <div>

                    <strong>Featured:</strong>

                    {{ $product->featured ? 'Yes' : 'No' }}

                </div>

                <div>

                    <strong>Status:</strong>

                    {{ $product->status ? 'Active' : 'Inactive' }}

                </div>

                <div>

                    <strong>Description</strong>

                    <div class="mt-2 p-4 bg-gray-100 rounded-lg">

                        {{ $product->description }}

                    </div>

                </div>

                <div>

                    <strong>Created:</strong>

                    {{ $product->created_at->format('d M Y h:i A') }}

                </div>

                <div>

                    <strong>Updated:</strong>

                    {{ $product->updated_at->format('d M Y h:i A') }}

                </div>

            </div>

        </div>

    </div>

</div>

@endsection