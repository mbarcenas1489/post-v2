<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;

class ReportsController extends Controller
{
    public function sales()
    {
        $sales = Sale::with('customer')->latest('date')->paginate(20);
        return view('reports.sales', compact('sales'));
    }

    public function lowStock()
    {
        $products = Product::whereColumn('stock', '<=', 'min_stock')->orderBy('stock')->paginate(20);
        return view('reports.low_stock', compact('products'));
    }
}
