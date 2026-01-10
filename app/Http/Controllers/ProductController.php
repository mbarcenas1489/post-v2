<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category','supplier'])->latest('id')->paginate(15);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('products.create', compact('categories','suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'sku' => ['required','string','max:255','unique:products,sku'],
            'category_id' => ['nullable','exists:categories,id'],
            'supplier_id' => ['nullable','exists:suppliers,id'],
            'barcode' => ['nullable','string','max:255'],
            'description' => ['nullable','string'],
            'cost_price' => ['required','numeric','min:0'],
            'sale_price' => ['required','numeric','min:0'],
            'stock' => ['required','integer','min:0'],
            'min_stock' => ['nullable','integer','min:0'],
            'status' => ['nullable','string','in:active,inactive'],
        ]);

        $data['status'] = $data['status'] ?? 'active';
        $product = Product::create($data);

        if (($data['stock'] ?? 0) > 0) {
            StockMovement::create([
                'product_id' => $product->id,
                'type' => 'in',
                'quantity' => (int) $data['stock'],
                'old_stock' => 0,
                'new_stock' => (int) $data['stock'],
                'reason' => 'Stock inicial',
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Producto creado.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category','supplier']);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();
        $suppliers = Supplier::orderBy('name')->get();
        return view('products.edit', compact('product','categories','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name' => ['required','string','max:255'],
            'sku' => ['required','string','max:255','unique:products,sku,'.$product->id],
            'category_id' => ['nullable','exists:categories,id'],
            'supplier_id' => ['nullable','exists:suppliers,id'],
            'barcode' => ['nullable','string','max:255'],
            'description' => ['nullable','string'],
            'cost_price' => ['required','numeric','min:0'],
            'sale_price' => ['required','numeric','min:0'],
            'stock' => ['required','integer','min:0'],
            'min_stock' => ['nullable','integer','min:0'],
            'status' => ['nullable','string','in:active,inactive'],
        ]);

        $prevStock = (int) $product->stock;
        $product->update($data);
        $newStock = (int) $data['stock'];
        $diff = $newStock - $prevStock;
        if ($diff !== 0) {
            StockMovement::create([
                'product_id' => $product->id,
                'type' => $diff > 0 ? 'in' : 'out',
                'quantity' => abs($diff),
                'old_stock' => $prevStock,
                'new_stock' => $newStock,
                'reason' => 'Ajuste manual de stock',
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Producto actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Producto eliminado.');
    }
}
