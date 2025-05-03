<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\sales;
use App\Models\Product;
use App\Models\category; 
use Carbon\Carbon;

class homeController extends Controller
{

    public function index()
    {
        // Calculate total sales for this month
        $totalSalesMonth = Sales::whereMonth('created_at', now()->month)
                               ->sum('total_amount');
    
        // Calculate total sales for today
        $totalSalesToday = Sales::whereDate('created_at', now()->toDateString())
                               ->sum('total_amount');
    
        // Fetch products and categories
        $products = Product::latest()->take(5)->get(); // Example: latest 5 products
        $categories = category::all();


        $salesLast7Days = Sales::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
        ->where('created_at', '>=', Carbon::now()->subDays(6)->startOfDay())
        ->groupBy('date')
        ->orderBy('date')
        ->get()
        ->keyBy('date');
    
    // Fill missing days with 0
    $days = collect();
    for ($i = 6; $i >= 0; $i--) {
        $date = Carbon::now()->subDays($i)->toDateString();
        $days->push([
            'date' => $date,
            'total' => $salesLast7Days[$date]->total ?? 0,
        ]);
    }
    $last7DaysSales = $days;
    
        return view('dashboard', compact('products', 'categories', 'totalSalesMonth', 'totalSalesToday','last7DaysSales'));
    }}
   
