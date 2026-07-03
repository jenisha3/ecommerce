<!DOCTYPE html>
<html>
<head>
    <title>Admin - Orders</title>
</head>
<body>

<h1>All Orders</h1>

<a href="{{ route('admin.dashboard') }}">Dashboard</a>

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
    <th>Customer</th>
    <th>Phone</th>
    <th>Total</th>
    <th>Status</th>
    <th>Date</th>
    <th>Action</th>
</tr>

@foreach($orders as $order)

<tr>

    <td>#{{ $order->id }}</td>

    <td>{{ $order->customer_name }}</td>

    <td>{{ $order->phone }}</td>

    <td>
        Rs. {{ number_format($order->total_amount,2) }}
    </td>

    <td>{{ $order->status }}</td>

    <td>{{ $order->created_at->format('d M Y') }}</td>

    <td>

        <a href="{{ route('admin.orders.show',$order->id) }}">
            View
        </a>

    </td>

</tr>

@endforeach

</table>

@else

<h3>No Orders Found.</h3>

@endif

</body>
</html>