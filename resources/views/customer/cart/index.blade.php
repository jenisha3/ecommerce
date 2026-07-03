<!DOCTYPE html>
<html>
<head>
    <title>My Cart</title>
</head>
<body>

<h1>My Cart</h1>

<a href="{{ route('shop') }}">Continue Shopping</a>

<hr>

{{-- Success Message --}}
@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

{{-- Error Message --}}
@if(session('error'))
    <p style="color:red;">
        {{ session('error') }}
    </p>
@endif

@if($carts->count())

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>Product</th>
        <th>Image</th>
        <th>Price</th>
        <th>Available Stock</th>
        <th>Quantity</th>
        <th>Total</th>
        <th>Action</th>
    </tr>

    @php
        $grandTotal = 0;
    @endphp

    @foreach($carts as $cart)

    @php
        $total = $cart->product->price * $cart->quantity;
        $grandTotal += $total;
    @endphp

    <tr>

        <td>{{ $cart->product->name }}</td>

        <td>
            @if($cart->product->image)
                <img src="{{ asset('storage/'.$cart->product->image) }}" width="80">
            @else
                No Image
            @endif
        </td>

        <td>
            Rs. {{ number_format($cart->product->price,2) }}
        </td>

        <td>
            {{ $cart->product->stock }}
        </td>

        <td>

            <form action="{{ route('cart.update',$cart->id) }}" method="POST">

                @csrf
                @method('PATCH')

                <input
                    type="number"
                    name="quantity"
                    value="{{ $cart->quantity }}"
                    min="1"
                    max="{{ $cart->product->stock }}"
                >

                <button type="submit">
                    Update
                </button>

            </form>

        </td>

        <td>
            Rs. {{ number_format($total,2) }}
        </td>

        <td>

            <form action="{{ route('cart.destroy',$cart->id) }}" method="POST">

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    onclick="return confirm('Remove this product from cart?')">
                    Remove
                </button>

            </form>

        </td>

    </tr>

    @endforeach

</table>

<br>

<h3>
    Grand Total :
    Rs. {{ number_format($grandTotal,2) }}
</h3>

<br>

<a href="{{ route('checkout.index') }}">
    <button>
        Proceed to Checkout
    </button>
</a>

@else

<h3>Your cart is empty.</h3>

<a href="{{ route('shop') }}">
    Continue Shopping
</a>

@endif

</body>
</html>