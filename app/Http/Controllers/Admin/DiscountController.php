<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use App\Models\Product;
use App\Models\Role;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // Mostrar todos los descuentos
    public function index()
    {
        // Obtener todos los descuentos con relaciones
        $discounts = Discount::with(['role', 'product'])->paginate(10);
        return view('admin.discounts.index', compact('discounts'));
    }

    // Mostrar formulario para crear un descuento
    public function create()
    {
        $roles = Role::all();  // Obtener todos los roles
        $products = Product::all(); // Obtener todos los productos
        return view('admin.discounts.create', compact('roles', 'products'));
    }

    // Guardar un nuevo descuento
    public function store(Request $request)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'product_id' => 'required|exists:products,id',
            'discount_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Crear el descuento
        Discount::create($validated);

        return redirect()->route('admin.discounts.index')->with('success', 'Descuento creado exitosamente');
    }

    // Mostrar formulario para editar un descuento
    public function edit(Discount $discount)
    {
        $roles = Role::all();
        $products = Product::all();
        return view('admin.discounts.edit', compact('discount', 'roles', 'products'));
    }

    // Actualizar un descuento
    public function update(Request $request, Discount $discount)
    {
        // Validación de los datos del formulario
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,id',
            'product_id' => 'required|exists:products,id',
            'discount_amount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Actualizar el descuento
        $discount->update($validated);

        return redirect()->route('admin.discounts.index')->with('success', 'Descuento actualizado exitosamente');
    }

    // Eliminar un descuento
    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discounts.index')->with('success', 'Descuento eliminado exitosamente');
    }
}