@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-5">
    <h2 class="text-2xl font-bold mb-4">Tunzaa Mauzo - Dashboard</h2>

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

    
    <div class="bg-white p-4 rounded shadow">
        <h3 class="text-xl font-semibold mb-2">Sales - Last 7 Days</h3>
        <table class="min-w-full table-auto">
            <thead>
                <tr>
                    <th class="px-4 py-2">Date</th>
                    <th class="px-4 py-2">Product</th>
                    <th class="px-4 py-2">Quantity</th>
                    <th class="px-4 py-2">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sales as $sale)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $sale->created_at->toDateString() }}</td>
                    <td class="px-4 py-2">{{ $sale->product->name }}</td>
                    <td class="px-4 py-2">{{ $sale->quantity }}</td>
                    <td class="px-4 py-2">{{ $sale->amount }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection