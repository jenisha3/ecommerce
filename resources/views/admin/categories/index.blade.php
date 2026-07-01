@extends('layouts.admin')

@section('title', 'Categories')

@section('content')

<h2>Category List</h2>

@if(session('success'))
    <p style="color:green;">
        {{ session('success') }}
    </p>
@endif

<a href="{{ route('categories.create') }}">
    Add Category
</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>

    @forelse($categories as $category)

        <tr>

            <td>{{ $category->id }}</td>

            <td>{{ $category->name }}</td>

            <td>{{ $category->slug }}</td>

            <td>{{ $category->description }}</td>

            <td>

                <a href="{{ route('categories.edit', $category->id) }}">
                    Edit
                </a>

                |

                <form action="{{ route('categories.destroy', $category->id) }}"
                      method="POST"
                      style="display:inline;">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            onclick="return confirm('Are you sure you want to delete this category?')">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

    @empty

        <tr>
            <td colspan="5">
                No Categories Found.
            </td>
        </tr>

    @endforelse

</table>

@endsection