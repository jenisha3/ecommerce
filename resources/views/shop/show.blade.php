<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
</head>
<body>

<h1>{{ $product->name }}</h1>

@if($product->image)

<img src="{{ asset('products/'.$product->image) }}"
width="250">

@endif

<p><strong>Category:</strong> {{ $product->category->name }}</p>

<p><strong>Description:</strong> {{ $product->description }}</p>

<p><strong>Price:</strong> Rs. {{ $product->price }}</p>

<p><strong>Discount Price:</strong> Rs. {{ $product->discount_price }}</p>

<p><strong>Stock:</strong> {{ $product->stock }}</p>

<p><strong>Status:</strong>

@if($product->status)

Available

@else

Out of Stock

@endif

</p>

<a href="{{ route('shop') }}">
    Back to Shop
</a>

</body>
</html>