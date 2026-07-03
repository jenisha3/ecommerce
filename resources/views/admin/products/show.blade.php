@extends('layouts.admin')

@section('title','Product Details')

@section('content')

<h2>Product Details</h2>

<p><strong>Category:</strong> {{ $product->category->name }}</p>

<p><strong>Name:</strong> {{ $product->name }}</p>

<p><strong>Slug:</strong> {{ $product->slug }}</p>

<p><strong>Description:</strong> {{ $product->description }}</p>

<p><strong>Price:</strong> {{ $product->price }}</p>

<p><strong>Discount Price:</strong> {{ $product->discount_price }}</p>

<p><strong>Stock:</strong> {{ $product->stock }}</p>

<p><strong>Featured:</strong> {{ $product->featured ? 'Yes' : 'No' }}</p>

<p><strong>Status:</strong> {{ $product->status ? 'Active' : 'Inactive' }}</p>

@if($product->image)

<img src="{{ asset('products/'.$product->image) }}"
width="180">

@endif

<br><br>

<a href="{{ route('admin.products.index') }}">
    Back
</a>

@endsection