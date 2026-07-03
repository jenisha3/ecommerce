<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h1>Admin Dashboard</h1>

<p>
    Welcome,
    <strong>{{ auth()->user()->name }}</strong>
</p>

<hr>

<ul>

    <li>
        <a href="{{ route('admin.dashboard') }}"> Dashboard </a>    
    </li>

    <li>
        <a href="{{ route('admin.categories.index') }}"> Categories</a>
    </li>

    <li>
        <a href="{{ route('admin.products.index') }}"> Products </a>
    </li>

    <li>
        <a href="{{ route('admin.orders.index') }}"> Orders</a>
    </li>

    <li>
        <a href="{{ route('admin.customers.index') }}">Customers  </a>
    </li>

</ul>

<hr>

<h2>Dashboard Statistics</h2>

<table border="1" cellpadding="10">

<tr>
    <td>Total Categories</td>
    <td>{{ $totalCategories }}</td>
</tr>

<tr>
    <td>Total Products</td>
    <td>{{ $totalProducts }}</td>
</tr>

<tr>
    <td>Total Customers</td>
    <td>{{ $totalCustomers }}</td>
</tr>

<tr>
    <td>Total Orders</td>
    <td>{{ $totalOrders }}</td>
</tr>

<tr>
    <td>Pending Orders</td>
    <td>{{ $pendingOrders }}</td>
</tr>

<tr>
    <td>Processing Orders</td>
    <td>{{ $processingOrders }}</td>
</tr>

<tr>
    <td>Shipped Orders</td>
    <td>{{ $shippedOrders }}</td>
</tr>

<tr>
    <td>Delivered Orders</td>
    <td>{{ $deliveredOrders }}</td>
</tr>

<tr>
    <td>Cancelled Orders</td>
    <td>{{ $cancelledOrders }}</td>
</tr>

<tr>
    <td>Total Revenue</td>
    <td>Rs. {{ number_format($totalRevenue,2) }}</td>
</tr>

<tr>
    <td>Low Stock Products</td>
    <td>{{ $lowStockProducts }}</td>
</tr>

</table>

<hr>

<form action="{{ route('logout') }}" method="POST">
    @csrf

    <button type="submit">
        Logout
    </button>

</form>

</body>
</html>