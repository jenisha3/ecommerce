<!DOCTYPE html>
<html>
<head>
    <title>Checkout</title>
</head>
<body>

<h1>Checkout</h1>

@if ($errors->any())
    <ul style="color:red;">
        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('checkout.store') }}" method="POST">

    @csrf

    <h2>Shipping Information</h2>

    <label>Name</label><br>
    <input
        type="text"
        name="customer_name"
        value="{{ old('customer_name', auth()->user()->name) }}"
        required>

    <br><br>

    <label>Email</label><br>

    <input
        type="email"
        name="email"
        value="{{ old('email', auth()->user()->email) }}"
        required>

    <br><br>

    <label>Phone Number</label><br>

    <input
        type="text"
        name="phone"
        value="{{ old('phone') }}"
        required>

    <br><br>

    <label>Shipping Address</label><br>

    <textarea
        name="shipping_address"
        rows="4"
        cols="50"
        required>{{ old('shipping_address') }}</textarea>

    <br><br>

    <label>Payment Method</label><br>

    <input
        type="radio"
        name="payment_method"
        value="Cash on Delivery"
        checked>

    Cash on Delivery

    <hr>

    <h2>Order Summary</h2>

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

    <br>

    <button type="submit">
        Place Order
    </button>

</form>

</body>
</html>