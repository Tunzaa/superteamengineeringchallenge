<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;
use App\Models\sales;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    public function index()
{
    $sales = sales::withCount('products')->latest()->paginate(10);
    return view('sales.index', compact('sales'));
}
    public function create()
    {
        $products = Product::all();
        return view('sales.create', compact('products'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'products.*.id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);
    
        $total = 0;
        foreach ($request->products as $item) {
            $product = Product::find($item['id']);
            $total += $product->price * $item['quantity'];
        }
    
        $sale = sales::create([
            'user_id' => Auth::id(), // 👈 Add this line
            'receipt_code' => 'TUN-R-' . time(),
            'total_amount' => $total,
        ]);
    
        foreach ($request->products as $item) {
            $product = Product::find($item['id']);
            $sale->products()->attach($product->id, [
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ]);
    
            // Optionally update stock
            $product->decrement('stock', $item['quantity']);
        }
    
        return redirect()->route('sales.index')->with('success', 'Sale recorded successfully.');
    }
    public function show($id)
{
    $sale = sales::with(['products', 'user'])->findOrFail($id);
    return view('sales.show', compact('sale'));
}

}
