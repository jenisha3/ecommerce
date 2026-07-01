<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>

<h1>Checkout</h1>

<p>Customer:
    {{ auth()->user()->name }}
</p>

<hr>

<table border="1" cellpadding="10">

<tr>
    <th>Product</th>
    <th>Price</th>
    <th>Qty</th>
    <th>Total</th>
</tr>

@foreach($carts as $cart)

<tr>

    <td>{{ $cart->product->name }}</td>

    <td>
        Rs. {{ number_format($cart->product->price,2) }}
    </td>

    <td>{{ $cart->quantity }}</td>

    <td>
        Rs. {{ number_format($cart->product->price * $cart->quantity,2) }}
    </td>

</tr>

@endforeach

</table>

<br>

<h2>
Grand Total:
Rs. {{ number_format($total,2) }}
</h2>

<hr>

<h3>Payment Method</h3>

<p>Cash on Delivery</p>

<form action="{{ route('checkout.store') }}" method="POST">

    @csrf

    <button type="submit">
        Place Order
    </button>

</form>

</body>
</html>