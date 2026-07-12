@extends('layouts.shop')

@section('title','Home')

@section('content')


<div class="bg-gradient-to-r from-slate-900 to-blue-700 rounded-xl text-white p-16 mb-10">

    <h1 class="text-5xl font-bold mb-4">
        Welcome to Gadget Store
    </h1>

    <p class="text-xl mb-6">
        Discover the latest smartphones, laptops, accessories and more.
    </p>

    <a href="{{ route('shop.products') }}"
       class="bg-white text-blue-700 px-6 py-3 rounded-lg font-semibold">

        Shop Now

    </a>

</div>

<!-- Categories -->

<h2 class="text-3xl font-bold mb-6">
    Shop by Category
</h2>

<div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">

@foreach($categories as $category)

<div class="bg-white rounded-xl shadow p-6 text-center">

    <h3 class="text-xl font-semibold">

        {{ $category->name }}

    </h3>

</div>

@endforeach

</div>



@endsection