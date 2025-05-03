<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\category;
use App\Models\sales;
use App\Models\statuses;
use App\Models\payment_methods;
use App\Models\payment_status;
use App\Models\payment_method;
use App\Models\sales_status;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Search functionality
        $searchQuery = $request->input('search', '');

        // Sort functionality
        $sortBy = $request->input('sort_by', 'name_asc');
        
        // Query the products and apply search, sorting, and pagination
        $productsQuery = Product::query();

        // Apply search filter if search query exists
        if ($searchQuery) {
            $productsQuery->where('name', 'like', '%' . $searchQuery . '%')
                ->orWhere('description', 'like', '%' . $searchQuery . '%');
        }

        // Apply sorting based on the selected option
        switch ($sortBy) {
            case 'price_asc':
                $productsQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $productsQuery->orderBy('price', 'desc');
                break;
            case 'name_asc':
                $productsQuery->orderBy('name', 'asc');
                break;
            case 'name_desc':
                $productsQuery->orderBy('name', 'desc');
                break;
            default:
                $productsQuery->orderBy('name', 'asc');
        }

        // Get paginated products with 12 items per page
        $products = $productsQuery->paginate(12);

        // Pass the products to the view
        return view('products.index', compact('products'));
    }
    public function create()
{
    // You can fetch categories if needed, or remove this part if not applicable
    // $categories = Category::all();

    return view('products.create');
}

    public function store(Request $request)
{
    // Validate the incoming request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'sku' => 'required|string|unique:products,sku',
        'category' => 'nullable|string',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'cost_price' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'unit' => 'required|string|max:10',
        'reorder_level' => 'nullable|integer|min:0',
    ]);

    // Create the product
    Product::create($validated);

    // Redirect to the product index page with a success message
    return redirect()->route('products.index')->with('success', 'Product created successfully!');
}
    public function edit($id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Get all categories
    $categories = category::all();

    // Pass the product and categories to the view              
}

    public function update(Request $request, $id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Validate the incoming request
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'sku' => 'required|string|unique:products,sku,' . $product->id,
        'category' => 'nullable|string',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'cost_price' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'unit' => 'required|string|max:10',
        'reorder_level' => 'nullable|integer|min:0',
    ]);

    // Update the product
    $product->update($validated);

    // Redirect to the product index page with a success message
    return redirect()->route('products.index')->with('success', 'Product updated successfully!');
}
    public function destroy($id)
{
    // Find the product by ID
    $product = Product::findOrFail($id);

    // Delete the product
    $product->delete();

    // Redirect to the product index page with a success message
    return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
}
}

// Compare this snippet from tunzaa-mauzo/app/Models/Product.php:
// <?php
//  namespace App\Models;   