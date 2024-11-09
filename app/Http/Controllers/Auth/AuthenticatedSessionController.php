<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login'); // Asegúrate de que tu formulario esté aquí
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validar el código de colaborador y la contraseña
        $request->validate([
            'collaborator_code' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Buscar al usuario con el código de colaborador
        $user = User::where('collaborator_code', $request->collaborator_code)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            // Si no se encuentra el usuario o la contraseña no coincide
            throw ValidationException::withMessages([
                'collaborator_code' => ['El código de colaborador o la contraseña son incorrectos.'],
            ]);
        }

        // Iniciar sesión para el usuario encontrado
        Auth::login($user);

        // Regenerar la sesión para evitar fijación de sesión
        $request->session()->regenerate();

        // Redirigir al usuario a su destino original o al dashboard
        return redirect()->intended(route('dashboard'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}