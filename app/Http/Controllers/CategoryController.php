<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Mostrar todas las categorías
    public function index()
    {
        // Obtiene todas las categorías con sus subcategorías
        $categories = Category::with('subcategories')->whereNull('parent_id')->get(); // Solo las categorías principales
        return view('categories.index', compact('categories'));
    }

    // Mostrar una categoría específica
    public function show($id)
    {
        // Obtiene la categoría específica junto con sus productos y subcategorías
        $category = Category::with(['products', 'subcategories'])->findOrFail($id);
        return view('categories.show', compact('category'));
    }
}