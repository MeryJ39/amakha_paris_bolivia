<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Role;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function requestConsultant(Request $request): RedirectResponse
    {
        $request->validate([
            'mk_code' => ['required', 'string', 'size:7'], // Cambio a size:7
        ]);

        Log::info('Requesting consultant role with code: ' . $request->mk_code);

        // Asegurarse de que Auth::user() devuelve un objeto User
        $user = Auth::user();
        if (!$user) {
            return Redirect::route('profile.edit')->withErrors(['mk_code' => 'Usuario no autenticado.']);
        }
        Log::info('User requesting consultant role: ' . $user->name);

        $mkCode = $request->mk_code;
        $validCode = 'ABCDEFG';

        if (strtoupper($mkCode) === strtoupper($validCode)) {
            $consultantRole = Role::where('name', 'Consultor')->first();
            Log::info('Consultant role found: ' . $consultantRole);

            if ($consultantRole) {
                // Asegurarse de que $user es un objeto User antes de llamar a save()
                if ($user instanceof User) {
                    $user->role_id = $consultantRole->id;
                    Log::info('User role updated to consultant: ' . $user->name);
                    Log::info('User role ID: ' . $user->role_id);
                    $user->save();
                    return Redirect::route('profile.edit')->with('status', 'consultant-role-updated');
                } else {
                    return Redirect::route('profile.edit')->withErrors(['mk_code' => 'Error al obtener el usuario.']);
                }
            } else {
                return Redirect::route('profile.edit')->withErrors(['mk_code' => 'El rol de consultor no existe.']);
            }
        } else {
            return Redirect::route('profile.edit')->withErrors(['mk_code' => 'Código MK inválido.']);
        }
    }
}