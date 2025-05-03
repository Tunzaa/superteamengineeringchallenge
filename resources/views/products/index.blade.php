@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Products</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <nav class="mb-6">
        <ul class="flex space-x-4">
               
            @foreach (App\Helpers\MenuHelper::getMenuFor(Auth::user()) as $menu)
                <li>
                    <a href="{{ url($menu['route']) }}" class="text-blue-500 hover:underline">
                        {{ $menu['name'] }}
                    </a>
                </li>
            @endforeach
            
        </ul>
    </nav>

    <a href="{{ route('products.create') }}" class="btn btn-primary">Create New Product</a>
    <!-- Button to trigger export -->
    <a href="{{ route('products.export') }}" class="btn btn-primary mb-3">Export Inventory</a>


    <table class="table mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Discounted Price</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>${{ number_format($product->price, 2) }}</td>
                    <td>${{ number_format($product->discounted_price, 2) }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
