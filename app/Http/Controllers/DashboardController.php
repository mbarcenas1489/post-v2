<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Customer;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $lowStockCount = Product::whereColumn('stock', '<=', 'min_stock')->count();
        $customers = Customer::count();
        $todaySales = Sale::whereDate('date', today())->sum('total');

        return view('dashboard', compact('totalProducts', 'lowStockCount', 'customers', 'todaySales'));
    }
}
