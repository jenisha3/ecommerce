<!DOCTYPE html>
<html>
<head>
    <title>Customers</title>
</head>
<body>

<h1>Customer List</h1>

<p>Total Customers: {{ $customers->count() }}</p>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
    </tr>

    @forelse($customers as $customer)
        <tr>
            <td>{{ $customer->id }}</td>
            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
        </tr>
    @empty
        <tr>
            <td colspan="3">No customers found.</td>
        </tr>
    @endforelse

</table>

</body>
</html>