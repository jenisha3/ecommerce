@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')

<div class="max-w-5xl mx-auto">

    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Add Product
            </h2>

            <p class="text-gray-500 mt-1">
                Create a new product for your store.
            </p>
        </div>

        <a href="{{ route('admin.products.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
            Back
        </a>
    </div>

    @if ($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 rounded-lg p-4 mb-6">

            <ul class="list-disc ml-5">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="bg-white rounded-xl shadow-lg p-8">

        <form action="{{ route('admin.products.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Category -->

                <div>

                    <label class="block font-semibold mb-2">
                        Category
                    </label>

                    <select
                        name="category_id"
                        class="w-full border rounded-lg px-4 py-2">

                        <option value="">
                            Select Category
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- Product Name -->

                <div>

                    <label class="block font-semibold mb-2">
                        Product Name
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        class="w-full border rounded-lg px-4 py-2">

                </div>


                <div>

                    <label class="block font-semibold mb-2">
                        Price
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="price"
                        value="{{ old('price') }}"
                        class="w-full border rounded-lg px-4 py-2">

                </div>


                <div>

                    <label class="block font-semibold mb-2">
                        Discount Price
                    </label>

                    <input
                        type="number"
                        step="0.01"
                        name="discount_price"
                        value="{{ old('discount_price') }}"
                        class="w-full border rounded-lg px-4 py-2">

                </div>
  

                <div>

                    <label class="block font-semibold mb-2">
                        Stock
                    </label>

                    <input
                        type="number"
                        name="stock"
                        value="{{ old('stock') }}"
                        class="w-full border rounded-lg px-4 py-2">

                </div>


                <div>

                    <label class="block font-semibold mb-2">
                        Product Image
                    </label>

                    <input
                        type="file"
                        name="image"
                        class="w-full border rounded-lg px-4 py-2">

                </div>

            </div>


            <div class="mt-6">

                <label class="block font-semibold mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    class="w-full border rounded-lg px-4 py-2">{{ old('description') }}</textarea>

            </div>


            <div class="mt-6 flex gap-8">

                <label class="flex items-center gap-2">

                    <input
                        type="checkbox"
                        name="featured"
                        value="1"
                        {{ old('featured') ? 'checked' : '' }}>

                    Featured Product

                </label>

                <label class="flex items-center gap-2">

                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        {{ old('status',1) ? 'checked' : '' }}>

                    Active

                </label>

            </div>


            <div class="mt-8 flex gap-4">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                    Save Product

                </button>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection