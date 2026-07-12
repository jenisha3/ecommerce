@extends('layouts.admin')

@section('title', 'Update Inventory')

@section('content')

<div class="max-w-3xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-3xl font-bold text-gray-800">
                Update Inventory
            </h2>

            <p class="text-gray-500 mt-1">
                Update product stock information.
            </p>

        </div>

        <a href="{{ route('admin.inventory.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">

            Back

        </a>

    </div>

    @if($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded-lg mb-6">

            <ul class="list-disc ml-5">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="bg-white shadow rounded-xl p-8">

        <form action="{{ route('admin.inventory.update', $product->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Product Name
                </label>

                <input
                    type="text"
                    value="{{ $product->name }}"
                    class="w-full border rounded-lg px-4 py-3 bg-gray-100"
                    readonly>

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Category
                </label>

                <input
                    type="text"
                    value="{{ $product->category->name }}"
                    class="w-full border rounded-lg px-4 py-3 bg-gray-100"
                    readonly>

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Current Stock
                </label>

                <input
                    type="number"
                    name="stock"
                    value="{{ old('stock', $product->stock) }}"
                    class="w-full border rounded-lg px-4 py-3">

            </div>

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full border rounded-lg px-4 py-3">

                    <option value="1"
                        {{ $product->status ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0"
                        {{ !$product->status ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>

            </div>

            <div class="mb-8">

                <label class="block font-semibold mb-2">
                    Featured Product
                </label>

                <select
                    name="featured"
                    class="w-full border rounded-lg px-4 py-3">

                    <option value="1"
                        {{ $product->featured ? 'selected' : '' }}>
                        Yes
                    </option>

                    <option value="0"
                        {{ !$product->featured ? 'selected' : '' }}>
                        No
                    </option>

                </select>

            </div>

            <div class="flex gap-4">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                    Update Inventory

                </button>

                <a
                    href="{{ route('admin.inventory.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection