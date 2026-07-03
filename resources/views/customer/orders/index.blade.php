<!DOCTYPE html>
<html>
<head>
    <title>My Orders</title>
</head>
<body>

<h1>My Orders</h1>

<p>Welcome, {{ auth()->user()->name }}</p>

<hr>

<a href="{{ route('dashboard') }}">Customer Dashboard</a> |
<a href="{{ route('shop') }}">Shop</a> |
<a href="{{ route('cart.index') }}">My Cart</a>

<hr>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

@if($orders->count())

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>Order ID</th>
        <th>Total Amount</th>
        <th>Payment Method</th>
        <th>Status</th>
        <th>Order Date</th>
        <th>Action</th>
    </tr>

    @foreach($orders as $order)

    <tr>

        <td>#{{ $order->id }}</td>

        <td>
            Rs. {{ number_format($order->total_amount, 2) }}
        </td>

        <td>
            {{ $order->payment_method }}
        </td>

        <td>
            {{ $order->status }}
        </td>

        <td>
            {{ $order->created_at->format('d M Y') }}
        </td>

        <td>
            <a href="{{ route('orders.show', $order->id) }}">
                View Details
            </a>
        </td>

    </tr>

    @endforeach

</table>

@else

<h3>You have not placed any orders yet.</h3>

<a href="{{ route('shop') }}">
    Start Shopping
</a>

@endif

</body>
</html>