<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
</head>
<body>

<h1>Admin Dashboard</h1>

<p>Welcome, <strong>{{ auth()->user()->name }}</strong></p>

<hr>



<ul>
    <li>
        <a href="{{ route('admin.dashboard') }}"> Dashboard</a>
    </li>

    <li>
        <a href="{{ route('categories.index') }}"> Categories</a>
    </li>

    <li>
        <a href="{{ route('products.index') }}"> Products</a>
    </li>

    <li>
        <a href="#"> Orders</a>
    </li>

    <li>
        <a href="#"> Customers</a>
    </li>

    <li>
        <a href="#"> Users</a>
    </li>
</ul>

<hr>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Logout</button>
</form>

</body>
</html>