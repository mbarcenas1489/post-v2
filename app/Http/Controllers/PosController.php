<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Models\Sale;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PosController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 'active')
            ->where('stock', '>', 0)
            ->with('category')
            ->orderBy('name')
            ->get();
            
        $customers = Customer::orderBy('name')->get();
        
        return view('pos.index', compact('products', 'customers'));
    }

    public function getCart()
    {
        return response()->json([
            'cart' => $this->getCartData()
        ]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $product = Product::findOrFail($request->product_id);
        
        if ($product->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Stock insuficiente. Disponible: ' . $product->stock
            ]);
        }

        $cart = session()->get('pos_cart', []);
        $productId = $request->product_id;

        if (isset($cart[$productId])) {
            $newQuantity = $cart[$productId]['quantity'] + $request->quantity;
            if ($newQuantity > $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock insuficiente. Disponible: ' . $product->stock
                ]);
            }
            $cart[$productId]['quantity'] = $newQuantity;
        } else {
            $cart[$productId] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->sale_price,
                'quantity' => $request->quantity,
                'stock' => $product->stock
            ];
        }

        session()->put('pos_cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Producto agregado al carrito',
            'cart' => $this->getCartData()
        ]);
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:0'
        ]);

        $cart = session()->get('pos_cart', []);
        $productId = $request->product_id;

        if ($request->quantity == 0) {
            unset($cart[$productId]);
        } else {
            $product = Product::findOrFail($request->product_id);
            if ($request->quantity > $product->stock) {
                return response()->json([
                    'success' => false,
                    'message' => 'Stock insuficiente. Disponible: ' . $product->stock
                ]);
            }
            $cart[$productId]['quantity'] = $request->quantity;
        }

        session()->put('pos_cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $this->getCartData()
        ]);
    }

    public function removeFromCart(Request $request)
    {
        $cart = session()->get('pos_cart', []);
        unset($cart[$request->product_id]);
        session()->put('pos_cart', $cart);

        return response()->json([
            'success' => true,
            'cart' => $this->getCartData()
        ]);
    }

    public function clearCart()
    {
        session()->forget('pos_cart');
        
        return response()->json([
            'success' => true,
            'message' => 'Carrito vaciado'
        ]);
    }

    public function processSale(Request $request)
    {
        $request->validate([
            'customer_id' => 'nullable|exists:customers,id',
            'cash_received' => 'required|numeric|min:0'
        ]);

        $cart = session()->get('pos_cart', []);
        
        if (empty($cart)) {
            return response()->json([
                'success' => false,
                'message' => 'El carrito está vacío'
            ]);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        if ($request->cash_received < $total) {
            return response()->json([
                'success' => false,
                'message' => 'El efectivo recibido es menor al total'
            ]);
        }

        DB::beginTransaction();
        
        try {
            // Crear la venta
            $sale = Sale::create([
                'customer_id' => $request->customer_id,
                'date' => now(),
                'total' => $total,
                'payment_method' => 'cash',
                'status' => 'completed'
            ]);

            // Crear los items de la venta y actualizar stock
            foreach ($cart as $item) {
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'subtotal' => $item['price'] * $item['quantity']
                ]);

                // Actualizar stock
                $product = Product::find($item['id']);
                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();

            // Limpiar carrito
            session()->forget('pos_cart');

            return response()->json([
                'success' => true,
                'message' => 'Venta procesada exitosamente',
                'sale_id' => $sale->id,
                'change' => $request->cash_received - $total
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'message' => 'Error al procesar la venta: ' . $e->getMessage()
            ]);
        }
    }

    public function printTicket($saleId)
    {
        $sale = Sale::with(['customer', 'items.product'])->findOrFail($saleId);
        
        return view('pos.ticket', compact('sale'));
    }

    private function getCartData()
    {
        $cart = session()->get('pos_cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return [
            'items' => array_values($cart),
            'total' => $total,
            'count' => count($cart)
        ];
    }
}
