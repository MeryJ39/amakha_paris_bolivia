<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
     // Mostrar el formulario para agregar una nueva dirección
    public function create()
    {
        return view('addresses.create');
    }

    // Guardar una nueva dirección
    public function store(Request $request)
    {
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'phone_number' => 'required|string|size:8',  // Aseguramos que el teléfono tenga 8 dígitos
            'is_default' => 'nullable|boolean',  // El campo is_default es nullable
        ]);

        // Establecer si la dirección es predeterminada
        $isDefault = $request->has('is_default') && $request->is_default; // Comprobamos si el checkbox está marcado

        // Si se establece una nueva dirección como predeterminada, asegurarse de que las demás no lo estén
        if ($isDefault) {
            $this->setDefaultAddress(); // Llamamos a la función para establecer la dirección predeterminada
        }

        // Crear la nueva dirección
        Address::create([
            'user_id' => Auth::id(),
            'address' => $request->address,
            'city' => $request->city,
            'department' => $request->department,
            'phone_number' => $request->phone_number,
            'is_default' => $isDefault,  // Guardamos el valor correcto para is_default
        ]);

        return redirect()->route('addresses.index')->with('success', 'Dirección agregada correctamente.');
    }

    // Mostrar todas las direcciones del usuario
    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->paginate(10);
        return view('addresses.index', compact('addresses'));
    }

    // Mostrar el formulario para editar una dirección
    public function edit(Address $address)
    {
        // Verificar que la dirección pertenezca al usuario
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        return view('addresses.edit', compact('address'));
    }

    // Actualizar la dirección
    public function update(Request $request, Address $address)
    {
        // Verificar que la dirección pertenezca al usuario
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'department' => 'required|string|max:100',
            'phone_number' => 'required|string|size:8',
            'is_default' => 'nullable|boolean',  // Aseguramos que sea nullable
        ]);

        // Si la dirección es marcada como predeterminada, asegurarse de que las demás no lo sean
        if ($request->has('is_default') && $request->is_default) {
            $this->setDefaultAddress(); // Llamamos a la función para establecer la dirección predeterminada
        }

        $address->update($request->only(['address', 'city', 'department', 'phone_number', 'is_default']));

        return redirect()->route('addresses.index')->with('success', 'Dirección actualizada correctamente.');
    }

    // Eliminar una dirección
    public function destroy(Address $address)
    {
        // Verificar que la dirección pertenezca al usuario
        if ($address->user_id !== Auth::id()) {
            abort(403);
        }

        $address->delete();

        return redirect()->route('addresses.index')->with('success', 'Dirección eliminada correctamente.');
    }

    // Función para establecer la dirección como predeterminada
    private function setDefaultAddress()
    {
        // Desmarcar todas las direcciones actuales del usuario como no predeterminadas
        Address::where('user_id', Auth::id())->update(['is_default' => false]);
    }
}