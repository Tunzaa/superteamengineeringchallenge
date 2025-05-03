@extends('layouts.app')

@section('content')
<div class="container">
    <h2>New Sale</h2>
    <form method="POST" action="{{ route('sales.store') }}">
        @csrf
        <div class="form-group">
            <label for="product_id">Product</label>
            <select name="product_id" class="form-control" required>
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (Stock: {{ $product->stock }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="quantity">Quantity</label>
            <input type="number" name="quantity" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Record Sale</button>
    </form>
</div>
@endsection
