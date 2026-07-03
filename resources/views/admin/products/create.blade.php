@extends('layouts.admin')

@section('title','Add Product')

@section('content')

<h2>Add Product</h2>

@if ($errors->any())

<ul>

@foreach ($errors->all() as $error)

<li style="color:red">{{ $error }}</li>

@endforeach

</ul>

@endif

<form action="{{ route('admin.products.store') }}"
      method="POST"
      enctype="multipart/form-data">

@csrf

<label>Category</label>

<br>

<select name="category_id">

<option value="">Select Category</option>

@foreach($categories as $category)

<option value="{{ $category->id }}">

{{ $category->name }}

</option>

@endforeach

</select>

<br><br>

<label>Product Name</label>

<br>

<input type="text"
       name="name"
       value="{{ old('name') }}">

<br><br>

<label>Description</label>

<br>

<textarea name="description"></textarea>

<br><br>

<label>Price</label>

<br>

<input type="number"
       step="0.01"
       name="price">

<br><br>

<label>Discount Price</label>

<br>

<input type="number"
       step="0.01"
       name="discount_price">

<br><br>

<label>Stock</label>

<br>

<input type="number"
       name="stock">

<br><br>

<label>Image</label>

<br>

<input type="file"
       name="image">

<br><br>

<label>

<input type="checkbox"
       name="featured">

Featured

</label>

<br><br>

<label>

<input type="checkbox"
       name="status"
       checked>

Active

</label>

<br><br>

<button type="submit">

Save Product

</button>

</form>

@endsection