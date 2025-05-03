<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {

    // Display a list of all products
    public function index() {
        // Get all products from the database
        $products = Product::all();

        // Return the products index view with the products data
        return view('products.index', compact('products'));
    }

    // Show the form to create a new product
    public function create() {
        return view('products.create');
    }

    // Store a new product in the database
    public function store(Request $request) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Create and store the new product
        Product::create($validatedData);

        // Redirect to the product index page with a success message
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Show the form to edit an existing product
    public function edit(Product $product) {
        return view('products.edit', compact('product'));
    }

    // Update an existing product in the database
    public function update(Request $request, Product $product) {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        // Update the product
        $product->update($validatedData);

        // Redirect to the product index page with a success message
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Delete a product from the database
    public function destroy(Product $product) {
        // Delete the product
        $product->delete();

        // Redirect to the product index page with a success message
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

        return response()->stream($callback, 200, $headers);
    }
}
