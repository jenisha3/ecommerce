<!DOCTYPE html>
<html>
<head>
    <title>Order Details</title>
</head>
<body>

<h1>Order Details</h1>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<p><strong>Order ID:</strong> {{ $order->id }}</p>

<p><strong>Customer:</strong> {{ $order->customer_name }}</p>

<p><strong>Email:</strong> {{ $order->email }}</p>

<p><strong>Phone:</strong> {{ $order->phone }}</p>

<p><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>

<p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>

<p><strong>Total:</strong> Rs. {{ number_format($order->total_amount,2) }}</p>

<p><strong>Status:</strong> {{ $order->status }}</p>

<hr>

<h2>Products</h2>

<table border="1" cellpadding="10">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Quantity</th>
        <th>Subtotal</th>
    </tr>

    @foreach($order->items as $item)
    <tr>
        <td>{{ $item->product->name }}</td>
        <td>Rs. {{ number_format($item->price,2) }}</td>
        <td>{{ $item->quantity }}</td>
        <td>Rs. {{ number_format($item->price * $item->quantity,2) }}</td>
    </tr>
    @endforeach

</table>

<br>

<h2>Update Order Status</h2>

<form action="{{ route('admin.orders.update', $order->id) }}" method="POST">

    @csrf
    @method('PUT')

    <select name="status">

        <option value="Pending" {{ $order->status=='Pending'?'selected':'' }}>
            Pending
        </option>

        <option value="Processing" {{ $order->status=='Processing'?'selected':'' }}>
            Processing
        </option>

        <option value="Shipped" {{ $order->status=='Shipped'?'selected':'' }}>
            Shipped
        </option>

        <option value="Delivered" {{ $order->status=='Delivered'?'selected':'' }}>
            Delivered
        </option>

        <option value="Cancelled" {{ $order->status=='Cancelled'?'selected':'' }}>
            Cancelled
        </option>

    </select>

    <button type="submit">
        Update Status
    </button>

</form>

<br>

<a href="{{ route('admin.orders.index') }}">
    Back to Orders
</a>

</body>
</html>