<!DOCTYPE html>
<html>
<head>
    <title>Customer Dashboard</title>
</head>
<body>

    <h1>Customer Dashboard</h1>
    <hr>
    <p>Welcome, {{ auth()->user()->name }}</p>
    <p>Email: {{ auth()->user()->email }}</p>
    <hr>
    <h3>Customer Menu</h3>
    <ul>
        <li>
            <a href="{{ route('dashboard') }}">Home</a>
        </li>

        <li>
            <a href="{{ route('shop') }}">Shop</a>
        </li>

        <li>
            <a href="{{ route('orders.index') }}">My Orders</a>
        </li>

        <li>
            <a href="{{ route('cart.index') }}">My Cart</a>
        </li>

        <li>
            <a href="#">Profile</a>
        </li>
    </ul>
    <hr>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>

</body>
</html>