<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
</head>
<body>
<h1>Admin Panel</h1>
<hr>
<p>
    Welcome,
    <strong>{{ auth()->user()->name }}</strong>
</p>
<hr>
<hr>
<h3>Admin Menu</h3>
<ul>
    <li>
        <a href="{{ route('admin.dashboard') }}">Dashboard</a>
    </li>

    <li>
        <a href="{{ route('admin.categories.index') }}">Categories</a>
    </li>

    <li>
        <a href="{{ route('admin.products.index') }}">Products</a>
    </li>
    <li>
        <a href="{{ route('admin.orders.index') }}">Orders</a>
    </li>
    <li>
    <a href="{{ route('admin.inventory.index') }}">Inventory </a>
</li>

</ul>
<hr>
@yield('content')

</body>
</html>