<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/shop');  // Redirige a la tienda directamente
});

// Ruta para la tienda
Route::get('/shop', function () {
    return view('shop.shop');  // Página de la tienda
});

Route::get('/dashboard', function () {
    $user = Auth::user(); // Obtener al usuario autenticado
    $userRoleId = $user->role_id; // Obtener el 'role_id' del usuario autenticado

    // Obtener los pedidos del usuario autenticado
    $orders = Order::where('user_id', Auth::id())->get();

    // Contar el total de pedidos del usuario
    $totalOrders = $orders->count();

    // Obtener el último pedido (si existe)
    $lastOrder = $orders->last();

    // Resumen de ventas (total por día, semana, mes)
    $todaySales = Order::whereDate('created_at', Carbon::today())->sum('total_amount');
    $weeklySales = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_amount');
    $monthlySales = Order::whereMonth('created_at', Carbon::now()->month)->sum('total_amount');

    // Productos con bajo stock o agotados
    $lowStockProducts = Product::where('stock', '<=', 51)->get();

    // Gráfico de ventas por día (último mes)
    $salesByDay = Order::selectRaw('DATE(created_at) as date, SUM(total_amount) as total')
        ->groupBy('date')
        ->whereDate('created_at', '>=', Carbon::now()->subMonth()) // Datos del último mes
        ->orderBy('date')
        ->get();

    // Pasar los datos a la vista
    return view('dashboard', compact(
        'userRoleId', 'totalOrders', 'lastOrder', 'todaySales', 'weeklySales',
        'monthlySales', 'lowStockProducts', 'salesByDay', 'user'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/consultant/request', [ProfileController::class, 'requestConsultant'])->name('profile.consultant.request');

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

    // Ruta para el callback de pago exitoso desde Libélula, incluyendo el orderId en la query
    Route::get('/api/pago-exitoso', [CheckoutController::class, 'paymentSuccess'])->name('payment.success');

    // Ruta para mostrar los errores
    Route::get('/checkout/error', [CheckoutController::class, 'showError'])->name('checkout.error');
});


use App\Http\Controllers\OrderController;

// Ruta para la confirmación del pedido
Route::get('/confirmacion-pedido/{orderId}', [OrderController::class, 'showConfirmation'])->name('shop.confirmation');

// Ruta para mostrar todos los pedidos del usuario
Route::get('/orders', [OrderController::class, 'index'])->name('orders');

// Ruta para mostrar el detalle de un pedido específico
Route::get('/orders/{orderId}', [OrderController::class, 'show'])->name('orders.show');



use App\Http\Controllers\Admin\OrderManagementController;


Route::prefix('admin/orders')->group(function () {
    Route::get('/', [OrderManagementController::class, 'index'])->name('admin.orders.index');  // Lista de pedidos
    Route::get('/{id}', [OrderManagementController::class, 'show'])->name('admin.orders.show');  // Detalles de pedido
    Route::post('/{id}/status', [OrderManagementController::class, 'updateStatus'])->name('admin.orders.updateStatus');  // Cambiar estado

    Route::post('/{order}/chat', [ChatController::class, 'store'])->name('admin.orders.start_chat'); // Cambiado el nombre de la ruta

});


// routes/web.php

Route::middleware('auth')->group(function () {  // Rutas protegidas por autenticación

    // Rutas para Chats
    Route::get('/chat/{chat}', [ChatController::class, 'show'])->name('chat.show'); // Mostrar un chat específico
    Route::post('/orders/{order}/chat', [ChatController::class, 'store'])->name('order.start_chat'); // Iniciar/Crear chat desde pedido

    // Rutas para Mensajes
    Route::post('/messages', [MessageController::class, 'store'])->name('messages.store'); // Guardar un nuevo mensaje

    // ... (otras rutas de tu aplicación)
});

Route::resource('chats', ChatController::class); // Genera rutas para todas las acciones CRUD en chats
Route::resource('messages', MessageController::class); // Genera rutas para todas las acciones CRUD en mensajes


use App\Http\Controllers\Admin\ProductManagementController;

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('products', ProductManagementController::class);
        Route::post('products/{product}/update-stock', [ProductManagementController::class, 'updateStock'])
            ->name('products.updateStock');
});



use App\Http\Controllers\Admin\CategoryManagementController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Rutas para Categorías
    Route::resource('categories', CategoryManagementController::class)->except(['show']); // No necesitamos 'show'

    // Rutas para Subcategorías
    Route::get('subcategories', [CategoryManagementController::class, 'indexSubcategory'])->name('subcategories.index'); // Agregar ruta index para listar subcategorías
    Route::post('subcategories/store', [CategoryManagementController::class, 'storeSubcategory'])->name('subcategories.store');
    Route::get('subcategories/create', [CategoryManagementController::class, 'createSubcategory'])->name('subcategories.create');
    Route::get('subcategories/{subcategory}/edit', [CategoryManagementController::class, 'editSubcategory'])->name('subcategories.edit');
    Route::put('subcategories/{subcategory}', [CategoryManagementController::class, 'updateSubcategory'])->name('subcategories.update');
    Route::delete('subcategories/{subcategory}', [CategoryManagementController::class, 'destroySubcategory'])->name('subcategories.destroy');
});



use App\Http\Controllers\Admin\UserManagementController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Rutas para Usuarios
    Route::resource('users', UserManagementController::class)->except(['show']); // Usamos resource pero excluimos show

    // Rutas para los roles
    Route::get('roles', [UserManagementController::class, 'indexRoles'])->name('roles.index'); // Ver todos los roles
    Route::get('roles/{role}/edit', [UserManagementController::class, 'editRole'])->name('roles.edit'); // Editar un rol
    Route::put('roles/{role}', [UserManagementController::class, 'updateRole'])->name('roles.update'); // Actualizar rol
});



use App\Http\Controllers\Admin\DiscountController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Rutas para los descuentos
    Route::resource('discounts', DiscountController::class)->except(['show']);
});


use App\Models\Subcategory;

Route::get('/productos/subcategoria/{subcategoryId}', function ($subcategoryId) {
    // Obtener la subcategoría
    $subcategory = Subcategory::findOrFail($subcategoryId);

    // Obtener los productos filtrados por la subcategoría
    $products = Product::where('subcategory_id', $subcategory->id)->get();

    // Retornar la vista con los productos filtrados
    return view('shop.bySubcategory', compact('products', 'subcategory'));
})->name('shop.products.bySubcategory');


// Ruta para la página "Sobre Nosotros"
Route::get('/sobre-nosotros', function () {
    return view('shop.about');
})->name('about');



use App\Http\Controllers\AddressController;

// Ruta para ver todas las direcciones del usuario
Route::get('/mis-direcciones', [AddressController::class, 'index'])->name('addresses.index');

// Ruta para agregar una nueva dirección
Route::get('/mis-direcciones/crear', [AddressController::class, 'create'])->name('addresses.create');

// Ruta para guardar una nueva dirección
Route::post('/mis-direcciones', [AddressController::class, 'store'])->name('addresses.store');

// Ruta para editar una dirección
Route::get('/mis-direcciones/{address}/editar', [AddressController::class, 'edit'])->name('addresses.edit');

// Ruta para actualizar una dirección
Route::put('/mis-direcciones/{address}', [AddressController::class, 'update'])->name('addresses.update');

// Ruta para eliminar una dirección
Route::delete('/mis-direcciones/{address}', [AddressController::class, 'destroy'])->name('addresses.destroy');



use Livewire\Livewire;



    // Configuración de la ruta personalizada para Livewire
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/livewire/update', $handle);
    });



require __DIR__.'/auth.php';
