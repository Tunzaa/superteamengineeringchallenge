<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaleController extends Controller
{
    /**
     * Store a new sale and decrement product stock.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock available.'], 400);
        }

        $amount = $product->price * $request->quantity;

        $sale = Sale::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'amount' => $amount,
        ]);

        $product->decrement('stock', $request->quantity);

        return response()->json([
            'message' => 'Sale recorded successfully.',
            'sale' => $sale,
        ]);
    }

    /**
     * List all sales for the logged-in user.
     */
    public function index()
    {
        $sales = Sale::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return response()->json(['sales' => $sales]);
    }

    /**
     * Show the form to edit a sale.
     */
    public function edit($id)
    {
        $sale = Sale::with('product')->where('user_id', Auth::id())->findOrFail($id);

        return response()->json(['sale' => $sale]);
    }

    /**
     * Update a sale.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $sale = Sale::where('user_id', Auth::id())->findOrFail($id);
        $product = $sale->product;

        // Restore the stock of the product for the old quantity
        $product->increment('stock', $sale->quantity);

        // Check if there's enough stock for the new quantity
        if ($product->stock < $request->quantity) {
            return response()->json(['message' => 'Not enough stock available for update.'], 400);
        }

        // Update the sale with the new quantity and amount
        $sale->update([
            'quantity' => $request->quantity,
            'amount' => $product->price * $request->quantity,
        ]);

        // Decrease the stock for the new quantity
        $product->decrement('stock', $request->quantity);

        return response()->json(['message' => 'Sale updated successfully.', 'sale' => $sale]);
    }

    /**
     * Delete a sale.
     */
    public function destroy($id)
    {
        $sale = Sale::where('user_id', Auth::id())->findOrFail($id);
        $product = $sale->product;

        // Restore the stock for the deleted sale
        $product->increment('stock', $sale->quantity);

        // Delete the sale
        $sale->delete();

        return response()->json(['message' => 'Sale deleted successfully.']);
    }

    /**
     * Export sales to CSV.
     */
    public function export()
    {
        $fileName = 'sales_export.csv';
        $sales = Sale::with('product')->where('user_id', Auth::id())->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Product', 'Quantity', 'Amount', 'Date'];

        $callback = function () use ($sales, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($sales as $sale) {
                fputcsv($file, [
                    $sale->product->name,
                    $sale->quantity,
                    $sale->amount,
                    $sale->created_at->toDateTimeString()
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
