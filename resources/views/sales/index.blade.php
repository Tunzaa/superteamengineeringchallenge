@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Sales History</h2>
        <a href="{{ route('sales.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> New Sale
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Invoice</th>
                        <th>Products</th>
                        <th>Total (Tsh)</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($sales as $sale)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sale->invoice_number }}</td>
                            <td>{{ $sale->products_count }}</td>
                            <td class="text-success fw-bold">Tsh {{ number_format($sale->total_amount, 2) }}</td>
                            <td>{{ $sale->created_at->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('sales.show', $sale->id) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No sales recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="mt-3">
                {{ $sales->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
