@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')

<h2>Add Category</h2>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color:red;">{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.categories.store') }}" method="POST">
    @csrf

    <label>Category Name</label>
    <br>
    <input type="text" name="name" value="{{ old('name') }}">
    <br><br>

    <label>Description</label>
    <br>
    <textarea name="description" rows="5" cols="40">{{ old('description') }}</textarea>
    <br><br>

    <button type="submit">Save Category</button>

</form>
<br>
<a href="{{ route('admin.categories.index') }}">
    Back to Categories
</a>
@endsection