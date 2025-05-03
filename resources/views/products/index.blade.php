@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold">All Products</h1>
            <p class="text-muted mb-0">Browse and manage your products easily.</p>
        </div>
        <div>
            <a href="{{ route('products.create') }}" class="btn btn-success">
                <i class="fas fa-plus-circle me-2"></i> Add New Product
            </a>
        </div>
    </div>

    {{-- Filters and Sorting Options --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Products..." id="productSearch" aria-label="Product search">
                <button class="btn btn-outline-primary" type="button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="col-md-6 text-end">
            <select class="form-select w-auto" id="sortBy" aria-label="Sort by">
                <option selected>Sort By</option>
                <option value="price_asc">Price: Low to High</option>
                <option value="price_desc">Price: High to Low</option>
                <option value="name_asc">Name: A to Z</option>
                <option value="name_desc">Name: Z to A</option>
            </select>
        </div>
    </div>

    {{-- Products Grid --}}
    <div class="row g-4">
        @foreach ($products as $product)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    {{-- <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}"> --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($product->description, 80) }}</p>
                        <p class="fw-bold text-primary">Price: {{ $product->price }}TZS</p>
                    </div>
                    <div class="card-footer bg-white border-0">
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary w-100">
                            <i class="fas fa-eye me-1"></i> View Details
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
