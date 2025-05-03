<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {

    /**
     * Display a list of all products.
     */
    public function index() {
        $products = Product::all();

        // Return the view with products data
        return view('products.index', compact('products'));
    }

    /**
     * Show the form to create a new product.
     */
    public function create() {
        return view('products.create');
    }

    /**
     * Store a new product in the database.
     */
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        $price = $request->price;
        $discounted = $price * 0.95;

        // Create a new product in the database
        Product::create([
            'name' => $request->name,
            'price' => $price,
            'discounted_price' => $discounted,
            'stock' => $request->stock,
        ]);

        // Return success message and redirect to the products index page
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Show the form to edit an existing product.
     */
    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    /**
     * Update an existing product in the database.
     */
    public function update(Request $request, Product $product) {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Calculate discounted price as 5% less than the original price
        $validatedData['discounted_price'] = $validatedData['price'] * 0.95;

        // Update the product
        $product->update($validatedData);

        // Return success message and redirect to the products index page
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Delete a product from the database.
     */
    public function destroy(Product $product) {
        $product->delete();

        // Return success message and redirect to the products index page
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    /**
     * Export the inventory (products) as a CSV file.
     */
    public function export() {
        $fileName = 'inventory_export.csv';
        $products = Product::all();

        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $columns = ['Product Name', 'Price', 'Stock', 'Created At', 'Updated At'];

        $callback = function () use ($products, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($products as $product) {
                fputcsv($file, [
                    $product->name,
                    $product->price,
                    $product->stock,
                    $product->created_at->toDateTimeString(),
                    $product->updated_at->toDateTimeString()
                ]);
            }

            fclose($file);
        };

        // Return CSV file download with a success message
        session()->flash('success', 'Products export started!');
        
        return response()->stream($callback, 200, $headers);
    }
}
