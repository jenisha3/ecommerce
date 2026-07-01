<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

@if($errors->any())
    @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
    @endforeach
@endif

<form action="{{ route('register.store') }}" method="POST">
    @csrf

    <label>Name</label><br>
    <input type="text" name="name"><br><br>

    <label>Email</label><br>
    <input type="email" name="email"><br><br>

    <label>Password</label><br>
    <input type="password" name="password"><br><br>

    <label>Confirm Password</label><br>
    <input type="password" name="password_confirmation"><br><br>

    <button type="submit">Register</button>

</form>

<br>

<a href="{{ route('login') }}">Login</a>

</body>
</html>