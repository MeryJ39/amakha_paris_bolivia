<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Web\CartController;

use App\Http\Controllers\CheckoutController;
use App\Models\Product;

// Ruta para mostrar la página de Checkout
Route::middleware('auth')->get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::middleware('auth')->post('/checkout/process', [CheckoutController::class, 'process'])->name('checkout.process');


Route::get('/',  [CartController::class,'index'])->name('index');
Route::get('/cart', [CartController::class, 'cart'])->name('cart.index');
Route::post('/add', [CartController::class, 'add'])->name('cart.store');
Route::post('/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/clear', [CartController::class, 'clear'])->name('cart.clear');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(middleware: ['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware(['auth','admin']);


Route::middleware(['auth'])->group(function () {
    Route::get('/consultant', function () {
        // Solo los consultores deberían llegar aquí
        $products = Product::all(); // Obtener todos los productos
        return view('Web.Tienda.consultant', compact('products'));
    })->name('consultant.index')->middleware('check.consultant');
});

use App\Http\Controllers\OrderController;

Route::post('/orders', [OrderController::class, 'store']);
// En routes/web.php
Route::post('/checkout/process', [OrderController::class, 'process'])->name('checkout.process');

