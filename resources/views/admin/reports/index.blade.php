@extends('layouts.admin')

@section('title','Sales Reports')

@section('content')

<h2>Sales Reports</h2>

<hr>

<h3>Statistics</h3>

<table border="1" cellpadding="10">

<tr>
    <th>Total Revenue</th>
    <td>Rs. {{ number_format($totalRevenue,2) }}</td>
</tr>

<tr>
    <th>Monthly Revenue</th>
    <td>Rs. {{ number_format($monthlyRevenue,2) }}</td>
</tr>

<tr>
    <th>Total Orders</th>
    <td>{{ $totalOrders }}</td>
</tr>

<tr>
    <th>Total Customers</th>
    <td>{{ $totalCustomers }}</td>
</tr>

<tr>
    <th>Total Products</th>
    <td>{{ $totalProducts }}</td>
</tr>

<tr>
    <th>Pending Orders</th>
    <td>{{ $pendingOrders }}</td>
</tr>

<tr>
    <th>Completed Orders</th>
    <td>{{ $completedOrders }}</td>
</tr>

<tr>
    <th>Cancelled Orders</th>
    <td>{{ $cancelledOrders }}</td>
</tr>

</table>

<br>

<h3>Top 5 Best Selling Products</h3>

<table border="1" cellpadding="10">

<tr>

<th>Product</th>

<th>Units Sold</th>

</tr>

@forelse($bestSellingProducts as $item)

<tr>

<td>

{{ $item->product->name ?? 'Deleted Product' }}

</td>

<td>

{{ $item->total_sold }}

</td>

</tr>

@empty

<tr>

<td colspan="2">

No Sales Yet

</td>

</tr>

@endforelse

</table>

<br>

<h3>Recent Orders</h3>

<table border="1" cellpadding="10">

<tr>

<th>ID</th>

<th>Customer</th>

<th>Total</th>

<th>Status</th>

<th>Date</th>

</tr>

@forelse($recentOrders as $order)

<tr>

<td>{{ $order->id }}</td>

<td>{{ $order->customer_name }}</td>

<td>Rs. {{ number_format($order->total_amount,2) }}</td>

<td>{{ $order->status }}</td>

<td>{{ $order->created_at->format('d M Y') }}</td>

</tr>

@empty

<tr>

<td colspan="5">

No Orders Found

</td>

</tr>

@endforelse

</table>

@endsection