@extends('layouts.admin')

@section('title', 'Add Category')

@section('content')

<div class="max-w-4xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-3xl font-bold text-gray-800">
                Add Category
            </h2>

            <p class="text-gray-500 mt-1">
                Create a new product category.
            </p>

        </div>

        <a href="{{ route('admin.categories.index') }}"
           class="bg-gray-600 hover:bg-gray-700 text-white px-5 py-2 rounded-lg">
            Back
        </a>

    </div>

    @if($errors->any())

        <div class="bg-red-100 border border-red-400 text-red-700 rounded-lg p-4 mb-6">

            <ul class="list-disc ml-5">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    <div class="bg-white shadow-lg rounded-xl p-8">

        <form action="{{ route('admin.categories.store') }}" method="POST">

            @csrf

            <!-- Category Name -->

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Category Name
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter category name"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">

            </div>

            <!-- Description -->

            <div class="mb-6">

                <label class="block font-semibold mb-2">
                    Description
                </label>

                <textarea
                    name="description"
                    rows="5"
                    placeholder="Enter category description"
                    class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>

            </div>

            <!-- Status -->

            <div class="mb-8">

                <label class="flex items-center gap-3">

                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        {{ old('status',1) ? 'checked' : '' }}>

                    <span>Active</span>

                </label>

            </div>

            <!-- Buttons -->

            <div class="flex gap-4">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">

                    Save Category

                </button>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection