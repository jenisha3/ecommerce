@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

<div class="max-w-7xl mx-auto">

    <div class="flex justify-between items-center mb-6">

        <div>

            <h2 class="text-3xl font-bold text-gray-800">
                Categories
            </h2>

            <p class="text-gray-500 mt-1">
                Manage all product categories.
            </p>

        </div>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow">
            + Add Category
        </a>

    </div>

    @if(session('success'))

        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
            {{ session('success') }}
        </div>

    @endif

    <!-- Search -->

    <div class="bg-white rounded-xl shadow p-5 mb-6">

        <form method="GET" action="{{ route('admin.categories.index') }}">

            <div class="flex gap-3">

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search category..."
                    class="flex-1 border rounded-lg px-4 py-2">

                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-5 rounded-lg">

                    Search

                </button>

                <a href="{{ route('admin.categories.index') }}"
                   class="bg-gray-500 hover:bg-gray-600 text-white px-5 py-2 rounded-lg">

                    Reset

                </a>

            </div>

        </form>

    </div>

    <!-- Table -->

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-slate-900 text-white">

                <tr>

                    <th class="text-left px-6 py-4">
                        ID
                    </th>

                    <th class="text-left px-6 py-4">
                        Category Name
                    </th>

                    <th class="text-left px-6 py-4">
                        Description
                    </th>

                    <th class="text-left px-6 py-4">
                        Status
                    </th>

                    <th class="text-center px-6 py-4">
                        Actions
                    </th>

                </tr>

            </thead>

            <tbody>

            @forelse($categories as $category)

                <tr class="border-b hover:bg-gray-50">

                    <td class="px-6 py-4">
                        {{ $category->id }}
                    </td>

                    <td class="px-6 py-4 font-semibold">
                        {{ $category->name }}
                    </td>

                    <td class="px-6 py-4">

                        {{ $category->description ?: '-' }}

                    </td>

                    <td class="px-6 py-4">

                        @if($category->status)

                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

                                Active

                            </span>

                        @else

                            <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

                                Inactive

                            </span>

                        @endif

                    </td>

                    <td class="px-6 py-4 text-center">

                        <a href="{{ route('admin.categories.edit',$category->id) }}"
                           class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded">

                            Edit

                        </a>

                        <form
                            action="{{ route('admin.categories.destroy',$category->id) }}"
                            method="POST"
                            class="inline">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                onclick="return confirm('Delete this category?')"
                                class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">

                                Delete

                            </button>

                        </form>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="5"
                        class="text-center py-8 text-gray-500">

                        No Categories Found.

                    </td>

                </tr>

            @endforelse

            </tbody>

        </table>

    </div>

    <div class="mt-6">

        {{ $categories->withQueryString()->links() }}

    </div>

</div>

@endsection