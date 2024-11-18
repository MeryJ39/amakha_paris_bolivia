<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validación de los campos. Incluimos last_name y phone como opcionales.
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],  // last_name es opcional
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['nullable', 'string', 'max:255'],  // phone es opcional
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Crear el usuario con los datos proporcionados. Se incluyen los campos last_name y phone.
        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,  // Guardar last_name si se proporciona
            'email' => $request->email,
            'phone' => $request->phone,  // Guardar phone si se proporciona
            'password' => Hash::make($request->password),
        ]);

        // Disparar el evento Registered
        event(new Registered($user));

        // Iniciar sesión con el usuario recién creado
        Auth::login($user);

        // Redirigir a la ruta del dashboard
        return redirect(route('dashboard', absolute: false));
    }
}