@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 text-dark fw-bold">Welcome to <span class="text-primary">{{config("app.name")}}</span></h1>
            <p class="text-muted mb-0">Monitor and manage your sales, products, and inventory with ease.</p>
        </div>
        <div>
            <i class="fas fa-chart-line fa-2x text-primary"></i>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-alt fa-lg text-success mb-2"></i>
                    <h6 class="text-muted">Total Sales This Month</h6>
                    <h3 class="text-success fw-bold">{{ number_format($totalSalesMonth, 2) }}TZS</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-day fa-lg text-info mb-2"></i>
                    <h6 class="text-muted">Total Sales Today</h6>
                    <h3 class="text-info fw-bold">{{ number_format($totalSalesToday, 2) }}TZS</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Sales Chart --}}
    <div class="card shadow border-0 mb-5">
        <div class="card-header bg-primary text-white d-flex align-items-center">
            <i class="fas fa-chart-bar me-2"></i> Last 7 Days Sales
        </div>
        <div class="card-body">
            <canvas id="salesChart" height="100"></canvas>
        </div>
    </div>

    {{-- Product Categories --}}
    <div class="mb-5">
        <h4 class="fw-bold mb-3">Product Categories <i class="fas fa-tags text-primary"></i></h4>
        <div class="d-flex flex-wrap gap-2">
            @foreach ($categories as $category)
                <a href="{{ route('category.show', $category->id) }}" class="btn btn-outline-primary rounded-pill px-4 py-2">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Featured Products --}}
    <div>
        <h4 class="fw-bold mb-4">Featured Products <i class="fas fa-star text-warning"></i></h4>
        <div class="row g-4">
            @foreach ($products as $product)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm border-0">
                        {{-- <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}"> --}}
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->description, 100) }}</p>
                            <p class="fw-bold text-primary">Price: ${{ $product->price }}</p>
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
    </div>
</div>

{{-- Chart Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($last7DaysSales->pluck('date')) !!},
            datasets: [{
                label: 'Total Sales (Tsh)',
                data: {!! json_encode($last7DaysSales->pluck('total')) !!},
                backgroundColor: 'rgba(0, 123, 255, 0.1)',
                borderColor: '#007bff',
                borderWidth: 2,
                tension: 0.4,
                pointRadius: 4,
                pointBackgroundColor: '#007bff',
                fill: true
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
@endsection
