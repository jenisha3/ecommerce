@extends('layouts.shop')

@section('title','Categories')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="bg-gradient-to-r from-blue-700 to-indigo-700 rounded-xl p-10 text-white mb-10">

        <h1 class="text-4xl font-bold">

            Product Categories

        </h1>

        <p class="mt-2 text-lg">

            Browse products by category.

        </p>

    </div>

    @if($categories->count())

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">

        @foreach($categories as $category)

        <a href="{{ route('shop.category',$category->id) }}">

            <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition duration-300 p-8 text-center">

                <div class="w-24 h-24 rounded-full bg-blue-100 flex items-center justify-center mx-auto mb-5">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-10 h-10 text-blue-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M20 7L12 3L4 7V17L12 21L20 17V7Z"/>

                    </svg>

                </div>

                <h2 class="text-2xl font-bold mb-3">

                    {{ $category->name }}

                </h2>

                <p class="text-gray-500 mb-5">

                    {{ $category->products_count }} Products

                </p>

                <span class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">

                    View Products

                </span>

            </div>

        </a>

        @endforeach

    </div>

    @else

        <div class="bg-white rounded-xl shadow-lg p-12 text-center">

            <h2 class="text-2xl font-bold">

                No Categories Found

            </h2>

        </div>

    @endif

</div>

@endsection