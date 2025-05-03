@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Product Details</h1>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">{{ $product->name }} <small class="text-muted">({{ $product->sku }})</small></h4>
            <p class="card-text"><strong>Category:</strong> {{ $product->category ?? 'N/A' }}</p>
            <p class="card-text"><strong>Description:</strong> {{ $product->description ?? 'No description' }}</p>
            <p class="card-text"><strong>Price:</strong> {{ number_format($product->price, 2) }}TZS</p>
            <p class="card-text"><strong>Cost Price:</strong> {{ number_format($product->cost_price, 2) ?? 'N/A' }}TZS</p>
            <p class="card-text"><strong>Stock:</strong> {{ $product->stock }} {{ $product->unit }}</p>
            <p class="card-text"><strong>Reorder Level:</strong> {{ $product->reorder_level ?? 'N/A' }}</p>
            <p class="card-text"><strong>Created At:</strong> {{ $product->created_at->format('Y-m-d H:i') }}</p>
            <p class="card-text"><strong>Last Updated:</strong> {{ $product->updated_at->format('Y-m-d H:i') }}</p>

            <a href="{{ route('products.index') }}" class="btn btn-secondary mt-3">Back to Products</a>
        </div>
    </div>
</div>
@endsection
