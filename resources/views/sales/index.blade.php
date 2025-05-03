@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Sales</h1>
    <a href="{{ route('sales.create') }}" class="btn btn-primary mb-3">New Sale</a>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
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
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($sales as $sale)
            <tr>
                <td>{{ $sale->product->name }}</td>
                <td>{{ $sale->quantity }}</td>
                <td>{{ number_format($sale->amount, 2) }}</td>
                <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <a href="{{ route('sales.edit', $sale->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('sales.destroy', $sale->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this sale?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
