<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/shop');  // Redirige a la tienda directamente
});

// Ruta para la tienda
Route::get('/shop', function () {
    return view('shop.shop');  // Página de la tienda
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;

Route::resource('categories', CategoryController::class);
Route::resource('subcategories', SubcategoryController::class);
Route::resource('products', ProductController::class);




// Ruta para mostrar los detalles del producto usando el slug
Route::get('/product/{slug}', [ProductController::class, 'productDetails'])->name('product.details');


use App\Http\Controllers\CheckoutController;

Route::middleware('auth')->group(function () {
    // Ruta para mostrar el carrito de compras
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

    // Ruta para procesar el pago
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});


use App\Http\Controllers\OrderController;

// Ruta para la confirmación del pedido
Route::get('/confirmacion-pedido/{orderId}', [OrderController::class, 'showConfirmation'])->name('shop.confirmation');

// Ruta para mostrar todos los pedidos del usuario
Route::get('/orders', [OrderController::class, 'index'])->name('orders');

// Ruta para mostrar el detalle de un pedido específico
Route::get('/orders/{orderId}', [OrderController::class, 'show'])->name('orders.show');


use Livewire\Livewire;



    // Configuración de la ruta personalizada para Livewire
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });



require __DIR__.'/auth.php';