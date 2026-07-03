<!DOCTYPE html>
<html>
<head>
    <title>{{ $category->name }}</title>
</head>
<body>

<h1>{{ $category->name }}</h1>

<a href="{{ route('shop') }}">
    Back to Shop
</a>

<hr>

@forelse($products as $product)

<div style="border:1px solid black;padding:15px;margin-bottom:20px;">

@if($product->image)

<img src="{{ asset('products/'.$product->image) }}"
width="150">

@endif

<h3>{{ $product->name }}</h3>

<p>Price: Rs. {{ $product->price }}</p>

<a href="{{ route('shop.product', $product->id) }}">
    View Details
</a>

</div>

@empty

<p>No products found in this category.</p>

@endforelse

</body>
</html>