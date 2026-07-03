@extends('layouts.admin')

@section('title', 'Inventory')

@section('content')

<h1>Inventory Management</h1>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>ID</th>
        <th>Product</th>
        <th>Category</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Status</th>
    </tr>

    @forelse($products as $product)

    <tr>

        <td>{{ $product->id }}</td>

        <td>{{ $product->name }}</td>

        <td>{{ $product->category->name }}</td>

        <td>Rs. {{ number_format($product->price,2) }}</td>

        <td>{{ $product->stock }}</td>

        <td>

            @if($product->stock == 0)

                <span style="color:red;font-weight:bold;">Out of Stock </span> 


            @elseif($product->stock <= 10)

                <span style="color:orange;font-weight:bold;"> Low Stock </span>
     
            @else

                <span style="color:green;font-weight:bold;"> In Stock </span>
               
            @endif

        </td>

    </tr>

    @empty

    <tr>
        <td colspan="6">
            No Products Found
        </td>
    </tr>

    @endforelse

</table>

@endsection