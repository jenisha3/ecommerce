@extends('layouts.admin')

@section('title', 'Inventory')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                Inventory Management
            </h2>

            <p class="text-gray-500 mt-1">
                Monitor and update product stock.
            </p>
        </div>

    </div>

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">

            {{ session('success') }}

        </div>

    @endif

    <!-- Search -->

    <div class="bg-white rounded-xl shadow p-6 mb-6">

        <form action="{{ route('admin.inventory.index') }}" method="GET">

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search product..."
                    class="border rounded-lg px-4 py-2">

                <select
                    name="category"
                    class="border rounded-lg px-4 py-2">

                    <option value="">All Categories</option>

                    @foreach($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ request('category')==$category->id ? 'selected' : '' }}>

                            {{ $category->name }}

                        </option>

                    @endforeach

                </select>

                <select
                    name="stock"
                    class="border rounded-lg px-4 py-2">

                    <option value="">All Stock</option>

                    <option value="in"
                        {{ request('stock')=='in' ? 'selected' : '' }}>
                        In Stock
                    </option>

                    <option value="low"
                        {{ request('stock')=='low' ? 'selected' : '' }}>
                        Low Stock
                    </option>

                    <option value="out"
                        {{ request('stock')=='out' ? 'selected' : '' }}>
                        Out of Stock
                    </option>

                </select>

                <div class="flex gap-2">

                    <button
                        class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                        Search

                    </button>

                    <a
                        href="{{ route('admin.inventory.index') }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>

    <!-- Inventory Table -->

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-900 text-white">

            <tr>

                <th class="px-5 py-4 text-left">Image</th>

                <th class="px-5 py-4 text-left">Product</th>

                <th class="px-5 py-4 text-left">Category</th>

                <th class="px-5 py-4 text-center">Stock</th>

                <th class="px-5 py-4 text-center">Status</th>

                <th class="px-5 py-4 text-center">Action</th>

            </tr>

            </thead>

            <tbody>

            @forelse($products as $product)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-5 py-4">

                        @if($product->image)

                            <img
                                src="{{ asset('products/'.$product->image) }}"
                                class="w-16 h-16 rounded object-cover">

                        @else

                            No Image

                        @endif

                    </td>

                    <td class="px-5 py-4">

                        <div class="font-semibold">

                            {{ $product->name }}

                        </div>

                    </td>

                    <td class="px-5 py-4">

                        {{ $product->category->name }}

                    </td>

                    <td class="px-5 py-4 text-center">

                        {{ $product->stock }}

                    </td>

                    <td class="px-5 py-4 text-center">

                        @if($product->stock==0)

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                Out of Stock

                            </span>

                        @elseif($product->stock<=5)

                            <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

                                Low Stock

                            </span>

                        @else

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                In Stock

                            </span>

                        @endif

                    </td>

                    <td class="px-5 py-4 text-center">

                        <a
                            href="{{ route('admin.inventory.edit',$product->id) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">

                            Update Stock

                        </a>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="6" class="text-center py-10">

                        No Products Found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $products->withQueryString()->links() }}

    </div>

</div>

@endsection