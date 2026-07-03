<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
</head>
<body>

<h1>Category List</h1>

<a href="{{ route('admin.categories.create') }}">Add Category</a>

<br><br>

@if(session('success'))
    <p>{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Slug</th>
        <th>Description</th>
        <th>Action</th>
    </tr>

    @forelse($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>
        <td>{{ $category->slug }}</td>
        <td>{{ $category->description }}</td>
        <td>

            <a href="{{ route('admin.categories.edit', $category->id) }}">
                Edit
            </a>

            |

            <form action="{{ route('admin.categories.destroy', $category->id) }}"
                  method="POST"
                  style="display:inline;">
                @csrf
                @method('DELETE')

                <button type="submit"
                        onclick="return confirm('Delete this category?')">
                    Delete
                </button>
            </form>

        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5">No Categories Found.</td>
    </tr>
    @endforelse

</table>

</body>
</html>