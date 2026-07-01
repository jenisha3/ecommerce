@extends('layouts.admin')

@section('title','Edit Product')

@section('content')

<h2>Edit Product</h2>

<form action="{{ route('products.update',$product->id) }}"
      method="POST"
      enctype="multipart/form-data">

@csrf
@method('PUT')

<label>Category</label>

<br>

<select name="category_id">

@foreach($categories as $category)

<option value="{{ $category->id }}"
{{ $product->category_id==$category->id ? 'selected':'' }}>

{{ $category->name }}

</option>

@endforeach

</select>

<br><br>

<label>Name</label>

<br>

<input type="text"
name="name"
value="{{ $product->name }}">

<br><br>

<label>Description</label>

<br>

<textarea name="description">{{ $product->description }}</textarea>

<br><br>

<label>Price</label>

<br>

<input type="number"
step="0.01"
name="price"
value="{{ $product->price }}">

<br><br>

<label>Discount Price</label>

<br>

<input type="number"
step="0.01"
name="discount_price"
value="{{ $product->discount_price }}">

<br><br>

<label>Stock</label>

<br>

<input type="number"
name="stock"
value="{{ $product->stock }}">

<br><br>

@if($product->image)

<img src="{{ asset('products/'.$product->image) }}"
width="120">

<br><br>

@endif

<label>New Image</label>

<br>

<input type="file"
name="image">

<br><br>

<label>

<input type="checkbox"
name="featured"
{{ $product->featured ? 'checked':'' }}>

Featured

</label>

<br><br>

<label>

<input type="checkbox"
name="status"
{{ $product->status ? 'checked':'' }}>

Active

</label>

<br><br>

<button type="submit">

Update Product

</button>

</form>

@endsection