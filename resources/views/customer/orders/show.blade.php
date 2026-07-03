<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
</head>
<body>

<h1>Order Details</h1>

<a href="{{ route('orders.index') }}">← Back to My Orders</a>

<hr>

<h3>Customer Information</h3>

<p><strong>Name:</strong> {{ $order->customer_name }}</p>
<p><strong>Email:</strong> {{ $order->email }}</p>
<p><strong>Phone:</strong> {{ $order->phone }}</p>
<p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>

<hr>

<h3>Order Information</h3>

<p><strong>Order ID:</strong> #{{ $order->id }}</p>
<p><strong>Status:</strong> {{ $order->status }}</p>
<p><strong>Payment:</strong> {{ $order->payment_method }}</p>
<p><strong>Date:</strong> {{ $order->created_at->format('d M Y h:i A') }}</p>

<hr>

<h3>Ordered Products</h3>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
    </tr>

    @foreach($order->items as $item)

    <tr>
        <td>{{ $item->product->name }}</td>

        <td>
            Rs. {{ number_format($item->price,2) }}
        </td>

        <td>{{ $item->quantity }}</td>

        <td>
            Rs. {{ number_format($item->price * $item->quantity,2) }}
        </td>
    </tr>

    @endforeach

</table>

<hr>

<h2>
    Grand Total:
    Rs. {{ number_format($order->total_amount,2) }}
</h2>

</body>
</html>