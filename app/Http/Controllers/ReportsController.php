<?php

namespace App\Http\Controllers;

use App\Exports\SalesExport;
use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Product;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export()
    {
        return Excel::download(new SalesExport, 'reporte_ventas.xlsx');
    }
}
