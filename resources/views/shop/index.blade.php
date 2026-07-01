<!DOCTYPE html>
<html>
<head>
    <title>Shop</title>
</head>
<body>

<h1>Shop</h1>

<p>Name: {{ auth()->user()->name }}</p>
<p>Email: {{ auth()->user()->email }}</p>
<p>Roles:
    {{ auth()->user()->getRoleNames()->implode(', ') }}
</p>

<a href="{{ route('dashboard') }}">Customer Dashboard</a>
|
<a href="{{ route('cart.index') }}">My Cart</a>

<hr>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

@if($products->count())

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>Image</th>
        <th>Category</th>
        <th>Product</th>
        <th>Description</th>
        <th>Price</th>
        <th>Action</th>
    </tr>

    @foreach($products as $product)

    <tr>

        <td>
            @if($product->image)
                <img src="{{ asset('storage/'.$product->image) }}"
                     width="100">
            @else
                No Image
            @endif
        </td>

        <td>
            {{ $product->category->name }}
        </td>

        <td>
            {{ $product->name }}
        </td>

        <td>
            {{ $product->description }}
        </td>

        <td>
            Rs. {{ number_format($product->price,2) }}
        </td>

        <td>

            <a href="{{ route('shop.product',$product->id) }}">
                View Details
            </a>

            <br><br>

            <form action="{{ route('cart.store',$product->id) }}" method="POST">

                @csrf

                <button type="submit">
                    Add to Cart
                </button>

            </form>

        </td>

    </tr>

    @endforeach

</table>

@else

<h3>No products available.</h3>

@endif

</body>
</html>