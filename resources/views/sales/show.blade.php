@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h3 class="text-primary">Sale #{{ $sale->id }}</h3>
        <p><strong>Date:</strong> {{ $sale->created_at->format('d M Y, H:i') }}</p>
        <p><strong>Sold By:</strong> {{ $sale->user->name ?? 'N/A' }}</p>
        <p><strong>Total Amount:</strong> <span class="text-success">${{ number_format($sale->total_amount, 2) }}</span></p>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">Items Sold</div>
        <div class="card-body">
            @if($sale->products->count())
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>SKU</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sale->products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->sku }}</td>
                                <td>${{ number_format($product->pivot->price, 2) }}</td>
                                <td>{{ $product->pivot->quantity }}</td>
                                <td class="text-end">${{ number_format($product->pivot->price * $product->pivot->quantity, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Total:</strong></td>
                            <td class="text-end fw-bold text-success">${{ number_format($sale->total_amount, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            @else
                <p class="text-muted">No products found for this sale.</p>
            @endif
        </div>
    </div>
</div>
@endsection
