<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\PosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return auth()->check() ? redirect()->route('dashboard') : redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::resources([
        'products' => ProductController::class,
        'customers' => CustomerController::class,
        'suppliers' => SupplierController::class,
        'categories' => CategoryController::class,
        'sales' => SaleController::class,
        'payments' => PaymentController::class,
        'stock-movements' => StockMovementController::class,
    ]);

    Route::get('/reports/sales', [ReportsController::class, 'sales'])->name('reports.sales');
    Route::get('/reports/low-stock', [ReportsController::class, 'lowStock'])->name('reports.low_stock');
    Route::get('/reports/export', [ReportsController::class, 'export'])->name('reports.export');

    // POS Routes
    Route::get('/pos', [PosController::class, 'index'])->name('pos.index');
    Route::get('/pos/cart', [PosController::class, 'getCart'])->name('pos.cart');
    Route::post('/pos/add-to-cart', [PosController::class, 'addToCart'])->name('pos.add-to-cart');
    Route::post('/pos/update-cart', [PosController::class, 'updateCart'])->name('pos.update-cart');
    Route::post('/pos/remove-from-cart', [PosController::class, 'removeFromCart'])->name('pos.remove-from-cart');
    Route::post('/pos/clear-cart', [PosController::class, 'clearCart'])->name('pos.clear-cart');
    Route::post('/pos/process-sale', [PosController::class, 'processSale'])->name('pos.process-sale');
    Route::get('/pos/ticket/{sale}', [PosController::class, 'printTicket'])->name('pos.ticket');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
