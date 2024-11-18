<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    // Mostrar todas las subcategorías
    public function index()
    {
        $subcategories = Subcategory::with('category')->get();
        return view('subcategories.index', compact('subcategories'));
    }

    // Mostrar el formulario para crear una nueva subcategoría
    public function create()
    {
        $categories = Category::all();
        return view('subcategories.create', compact('categories'));
    }

    // Almacenar una nueva subcategoría
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        Subcategory::create($request->all());

        return redirect()->route('subcategories.index');
    }

    // Mostrar una subcategoría específica
    public function show($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        return view('subcategories.show', compact('subcategory'));
    }

    // Mostrar el formulario para editar una subcategoría
    public function edit($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $categories = Category::all();
        return view('subcategories.edit', compact('subcategory', 'categories'));
    }

    // Actualizar una subcategoría existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($request->all());

        return redirect()->route('subcategories.index');
    }

    // Eliminar una subcategoría
    public function destroy($id)
    {
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('subcategories.index');
    }
}