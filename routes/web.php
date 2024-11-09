<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

// Ruta principal, mostrará la vista welcome
Route::get('/', function () {
    return view('welcome');
});

// Ruta para el dashboard, accesible solo para usuarios autenticados y verificados
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas para el perfil de usuario, solo accesibles para usuarios autenticados
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Requerir las rutas de autenticación proporcionadas por Laravel Breeze
require __DIR__.'/auth.php';  // Esto incluye las rutas de login, registro, etc.