@extends('layouts.admin')

@section('title','Customer Details')

@section('content')

<h2>Customer Details</h2>

<p><strong>Name:</strong> {{ $customer->name }}</p>

<p><strong>Email:</strong> {{ $customer->email }}</p>

<p><strong>Total Orders:</strong> {{ $customer->orders->count() }}</p>

<hr>

<h3>Orders</h3>

<table border="1" cellpadding="10">

<tr>
    <th>Order ID</th>
    <th>Total</th>
    <th>Status</th>
    <th>Date</th>
</tr>

@forelse($customer->orders as $order)

<tr>

    <td>{{ $order->id }}</td>

    <td>Rs. {{ number_format($order->total_amount,2) }}</td>

    <td>{{ $order->status }}</td>

    <td>{{ $order->created_at->format('d M Y') }}</td>

</tr>

@empty

<tr>

<td colspan="4">
No Orders Yet.
</td>

</tr>

@endforelse

</table>

@endsection