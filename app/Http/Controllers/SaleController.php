<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\SalesExport;
use Maatwebsite\Excel\Facades\Excel;
class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with(['customer', 'items'])->latest('date')->paginate(15);
        //return $sales;
       return view('sales.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('sales.Create.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        // Convertir JSON a array
        $products = json_decode($request->products, true);

        if (empty($products)) {
            return back()->with('error', 'No hay productos en la venta');
        }

        DB::beginTransaction();

        try {

            // 1. Crear la venta
            $sale = Sale::create([
                'invoice_number' => 'FAC-' . time(),  // o genera como quieras
                'date' => now(),
                'customer_id' => 1, // puedes reemplazar esto
                'subtotal' => $request->subtotal,
                'tax' => 0, // si no manejas impuestos
                'discount' => 0,
                'total' => $request->total,
                'status' => 'completed'
            ]);

            // 2. Guardar los items
            foreach ($products as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'discount' => 0,
                    'total' => $item['subtotal'],
                ]);
            }
            DB::commit();
//            return redirect()->back()->with('success', 'Venta guardada correctamente');
            return redirect()->route('sales.index')->with('success', 'Venta actualizada correctamente');

        }
        catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al guardar la venta: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale)
    {
        $sale->load(['items']);
        $products = Product::all();
        return view('sales.edit.edit', compact('sale', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'products' => 'required',
            'subtotal' => 'required|numeric',
            'total' => 'required|numeric',
        ]);

        // Convertir JSON a array
        $products = json_decode($request->products, true);

        if (empty($products)) {
            return back()->with('error', 'No hay productos en la venta');
        }

        DB::beginTransaction();

        try {
            // 1. Encontrar la venta existente
            $sale = Sale::findOrFail($id);

            // 2. Actualizar la venta
            $sale->update([
                'subtotal' => $request->subtotal,
                'tax' => 0, // si no manejas impuestos
                'discount' => 0,
                'total' => $request->total,
                'status' => 'completed'
            ]);

            // 3. Eliminar los items anteriores
            $sale->items()->delete();

            // 4. Crear los nuevos items
            foreach ($products as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['price'],
                    'discount' => 0,
                    'total' => $item['subtotal'],
                ]);
            }

            DB::commit();
//            return redirect()->back()->with('success', 'Venta actualizada correctamente');
            return redirect()->route('sales.index')->with('success', 'Venta actualizada correctamente');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Error al actualizar la venta: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale)
    {
        //
    }

    public function export()
    {
        return Excel::download(new SalesExport, 'reporte_ventas.xlsx');
    }
}
