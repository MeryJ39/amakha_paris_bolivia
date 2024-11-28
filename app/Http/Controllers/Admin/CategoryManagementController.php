<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryManagementController extends Controller
{
     // Mostrar todas las categorías
    public function index()
    {
        $categories = Category::paginate(10); // O puedes usar paginación: Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    // Mostrar el formulario para crear una categoría
    public function create()
    {
        return view('admin.categories.create');
    }

    // Guardar una nueva categoría
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría creada exitosamente');
    }

    // Mostrar el formulario para editar una categoría
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    // Actualizar una categoría existente
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Categoría actualizada exitosamente');
    }

    // Eliminar una categoría
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Categoría eliminada exitosamente');
    }

    // Mostrar el formulario para crear una subcategoría
    public function createSubcategory()
    {
        $categories = Category::all(); // Obtener todas las categorías
        return view('admin.subcategories.create', compact('categories'));
    }

    // Guardar una nueva subcategoría
    public function storeSubcategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id', // Asegúrate que la categoría exista
            'description' => 'nullable|string',
        ]);

        Subcategory::create($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Subcategoría creada exitosamente');
    }

    // Mostrar el formulario para editar una subcategoría
    public function editSubcategory(Subcategory $subcategory)
    {
        $categories = Category::all(); // Obtener todas las categorías
        return view('admin.subcategories.edit', compact('subcategory', 'categories'));
    }

    // Actualizar una subcategoría existente
    public function updateSubcategory(Request $request, Subcategory $subcategory)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $subcategory->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Subcategoría actualizada exitosamente');
    }

    // Eliminar una subcategoría
    public function destroySubcategory(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Subcategoría eliminada exitosamente');
    }

    // Método para listar las subcategorías
    public function indexSubcategory()
    {
        $subcategories = Subcategory::with('category')->paginate(10); // 10 es el número de elementos por página
        return view('admin.subcategories.index', compact('subcategories'));
    }
}