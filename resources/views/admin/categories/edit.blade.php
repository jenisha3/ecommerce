@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')

<h2>Edit Category</h2>

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li style="color:red;">{{ $error }}</li>
        @endforeach
    </ul>
@endif

<form action="{{ route('admin.categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Category Name</label>
    <br>
    <input type="text" name="name" value="{{ old('name', $category->name) }}">
    <br><br>

    <label>Description</label>
    <br>
    <textarea name="description" rows="5" cols="40">{{ old('description', $category->description) }}</textarea>
    <br><br>

    <button type="submit">Update Category</button>

</form>

<br>

<a href="{{ route('admin.categories.index') }}">
    Back to Categories
</a>

@endsection