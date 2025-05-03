@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Sale</h2>

    <form action="{{ route('sales.store') }}" method="POST">
        @csrf

        <div id="product-list">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Product</label>
                    <select name="products[0][id]" class="form-control">
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->price }}TZS</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Quantity</label>
                    <input type="number" name="products[0][quantity]" class="form-control" min="1">
                </div>
            </div>
        </div>

        <button type="button" id="add-product" class="btn btn-sm btn-outline-secondary mb-3">+ Add Another Product</button>

        <div>
            <button type="submit" class="btn btn-primary">Submit Sale</button>
        </div>
    </form>
</div>

<script>
let index = 1;
document.getElementById('add-product').addEventListener('click', function () {
    const productList = document.getElementById('product-list');
    const row = `
        <div class="row mb-3">
            <div class="col-md-6">
                <select name="products[${index}][id]" class="form-control">
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }} - {{ $product->price }}TZS</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <input type="number" name="products[${index}][quantity]" class="form-control" min="1">
            </div>
        </div>`;
    productList.insertAdjacentHTML('beforeend', row);
    index++;
});
</script>
@endsection
