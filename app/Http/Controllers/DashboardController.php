<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $sales = Sale::with('product')
            ->where('created_at', '>=', Carbon::now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboard', compact('sales'));
    }
}