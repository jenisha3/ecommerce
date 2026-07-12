@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
    <div>
        <h2 class="text-3xl font-bold text-gray-800">Products</h2>
        <p class="text-gray-500 mt-1">
            Manage all products from here.
        </p>
    </div>

    <a href="{{ route('admin.products.create') }}"
       class="mt-4 md:mt-0 bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
        + Add Product
    </a>
</div>

@if(session('success'))
<div class="mb-5 rounded-lg bg-green-100 border border-green-400 text-green-700 px-4 py-3">
    {{ session('success') }}
</div>
@endif

<form action="{{ route('admin.products.index') }}"
      method="GET"
      class="bg-white rounded-lg shadow p-5 mb-6">

    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        <div>
            <label class="block text-sm font-semibold mb-2">
                Search
            </label>

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Search product..."
                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
        </div>

        <div>
            <label class="block text-sm font-semibold mb-2">
                Category
            </label>

            <select
                name="category"
                class="w-full border rounded-lg px-3 py-2">

                <option value="">All Categories</option>

                @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    {{ request('category') == $category->id ? 'selected' : '' }}>

                    {{ $category->name }}

                </option>

                @endforeach

            </select>
        </div>

        


        <div class="flex items-end gap-2">

            <button
                type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                Search

            </button>

            <a
                href="{{ route('admin.products.index') }}"
                class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                Reset

            </a>

        </div>

    </div>

</form>

<div class="bg-white rounded-lg shadow overflow-hidden">

<table class="min-w-full">

<thead class="bg-gray-100">

<tr>

<th class="px-4 py-3 text-left">Image</th>
<th class="px-4 py-3 text-left">Name</th>
<th class="px-4 py-3 text-left">Category</th>
<th class="px-4 py-3 text-left">Price</th>
<th class="px-4 py-3 text-left">Discount</th>
<th class="px-4 py-3 text-left">Stock</th>
<th class="px-4 py-3 text-left">Featured</th>
<th class="px-4 py-3 text-left">Status</th>
<th class="px-4 py-3 text-center">Actions</th>

</tr>

</thead>

<tbody class="divide-y">

@forelse($products as $product)

<tr class="hover:bg-gray-50">

<td class="px-4 py-3">

@if($product->image)

<img
src="{{ asset('products/'.$product->image) }}"
class="w-16 h-16 rounded object-cover">

@else

<div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center text-xs">
No Image
</div>

@endif

</td>

<td class="px-4 py-3 font-semibold">
{{ $product->name }}
</td>

<td class="px-4 py-3">
{{ $product->category->name }}
</td>

<td class="px-4 py-3">
Rs. {{ number_format($product->price,2) }}
</td>

<td class="px-4 py-3">

@if($product->discount_price)

Rs. {{ number_format($product->discount_price,2) }}

@else

-

@endif

</td>
<td class="px-4 py-3">

    @if($product->stock == 0)

        <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm font-semibold">
            Out of Stock ({{ $product->stock }})
        </span>

    @elseif($product->stock <= 5)

        <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
            Low Stock ({{ $product->stock }})
        </span>

    @else

        <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-semibold">
            In Stock ({{ $product->stock }})
        </span>

    @endif

</td>

<td class="px-4 py-3">

    @if($product->featured)

        <span class="inline-block bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm">
            Yes
        </span>

    @else

        <span class="inline-block bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">
            No
        </span>

    @endif

</td>

<td class="px-4 py-3">

    @if($product->status)

        <span class="inline-block bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
            Active
        </span>

    @else

        <span class="inline-block bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
            Inactive
        </span>

    @endif

</td>

<td class="px-4 py-3">

    <div class="flex gap-2 justify-center">

        <a href="{{ route('admin.products.show',$product->id) }}"
           class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded text-sm">
            View
        </a>

        <a href="{{ route('admin.products.edit',$product->id) }}"
           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded text-sm">
            Edit
        </a>

        <form action="{{ route('admin.products.destroy',$product->id) }}"
              method="POST"
              onsubmit="return confirm('Delete this product?')">

            @csrf
            @method('DELETE')

            <button
                class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded text-sm">
                Delete
            </button>

        </form>

    </div>

</td>

</tr>

@empty

<tr>

    <td colspan="9" class="text-center py-8 text-gray-500">
        No Products Found
    </td>

</tr>

@endforelse

</tbody>

</table>

</div>

<div class="mt-6">

    {{ $products->withQueryString()->links() }}

</div>

@endsection