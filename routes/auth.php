<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    // Registro de usuario
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register'); // Vista de registro

    Route::post('register', [RegisteredUserController::class, 'store']); // Procesar registro

    // Login de usuario
    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login'); // Vista de login

    Route::post('login', [AuthenticatedSessionController::class, 'store']); // Procesar login

    // Recuperación de contraseña (si el usuario olvida la contraseña)
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request'); // Vista de solicitud de restablecimiento de contraseña

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email'); // Enviar el link de restablecimiento

    // Restablecer la contraseña con el token recibido
    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset'); // Vista para ingresar la nueva contraseña

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store'); // Procesar el restablecimiento de la contraseña
});

Route::middleware('auth')->group(function () {
    // Verificación de email del usuario (en caso de que no se haya verificado aún)
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice'); // Vista que muestra la notificación para verificar el email

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify'); // Verificar el email del usuario

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send'); // Enviar nuevo email de verificación

    // Confirmación de contraseña (en caso de que el usuario quiera cambiar la contraseña)
    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm'); // Vista para confirmar la contraseña

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']); // Procesar la confirmación

    // Cambiar la contraseña del usuario
    Route::put('password', [PasswordController::class, 'update'])->name('password.update'); // Procesar el cambio de contraseña

    // Logout (cerrar sesión del usuario)
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout'); // Procesar el logout
});
