@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<h2>Product List</h2>

@if(session('success'))
    <p style="color:green;">{{ session('success') }}</p>
@endif

<a href="{{ route('admin.products.create') }}">Add Product</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">

    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Category</th>
        <th>Name</th>
        <th>Price</th>
        <th>Discount Price</th>
        <th>Stock</th>
        <th>Featured</th>
        <th>Status</th>
        <th>Actions</th>
    </tr>

    @forelse($products as $product)

    <tr>

        <td>{{ $product->id }}</td>

        <td>
            @if($product->image)
                <img src="{{ asset('products/'.$product->image) }}"
                     width="70">
            @endif
        </td>

        <td>{{ $product->category->name }}</td>

        <td>{{ $product->name }}</td>

        <td>{{ $product->price }}</td>

        <td>{{ $product->discount_price }}</td>

        <td>
    {{ $product->stock }}

    <br>

    @if($product->stock == 0)
        <span style="color:red;">
            Out of Stock
        </span>

    @elseif($product->stock <= 5)
        <span style="color:orange;">
            Low Stock
        </span>

    @else
        <span style="color:green;">
            In Stock
        </span>
    @endif

</td>

        <td>{{ $product->featured ? 'Yes' : 'No' }}</td>

        <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>

        <td>

            <a href="{{ route('admin.products.show', $product->id) }}">View</a> |

            <a href="{{ route('admin.products.edit', $product->id) }}">Edit</a> |

            <form action="{{ route('admin.products.destroy', $product->id) }}"
                  method="POST"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button type="submit"
                onclick="return confirm('Delete this product?')">
                    Delete
                </button>

            </form>

        </td>

    </tr>

    @empty

    <tr>

        <td colspan="10">
            No Products Found.
        </td>

    </tr>

    @endforelse

</table>

@endsection