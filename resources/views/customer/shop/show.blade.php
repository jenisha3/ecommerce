<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }}</title>
</head>
<body>
@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

@if(session('error'))
    <p style="color:red;">
        {{ session('error') }}
    </p>
@endif
<h1>{{ $product->name }}</h1>

@if($product->image)

<img src="{{ asset('products/'.$product->image) }}" width="250">

@endif

<p><strong>Category:</strong> {{ $product->category->name }}</p>

<p><strong>Description:</strong> {{ $product->description }}</p>

<p><strong>Price:</strong> Rs. {{ $product->price }}</p>

@if($product->discount_price)
<p><strong>Discount Price:</strong> Rs. {{ $product->discount_price }}</p>
@endif

<p><strong>Stock:</strong> {{ $product->stock }}</p>

@if($product->stock > 5)

<p style="color:green;">
    <strong>Status:</strong> In Stock
</p>

@elseif($product->stock > 0)

<p style="color:orange;">
    <strong>Status:</strong> Low Stock
</p>

@else

<p style="color:red;">
    <strong>Status:</strong> Out of Stock
</p>

@endif

<br>

@if(session('error'))
    <p style="color:red;">
        {{ session('error') }}
    </p>
@endif

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

@if($product->stock > 0)

<form action="{{ route('cart.store', $product->id) }}" method="POST">

    @csrf

    <button type="submit">
        Add to Cart
    </button>

</form>

@else

<button disabled>
    Out of Stock
</button>

@endif

<br><br>

<a href="{{ route('shop') }}">
    Back to Shop
</a>

</body>
</html>