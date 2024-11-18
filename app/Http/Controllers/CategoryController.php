<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   // Mostrar todas las categorías
   public function index()
   {
       $categories = Category::all();
       return view('categories.index', compact('categories'));
   }

   // Mostrar el formulario para crear una nueva categoría
   public function create()
   {
       return view('categories.create');
   }

   // Almacenar una nueva categoría
   public function store(Request $request)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'image' => 'nullable|string',
       ]);

       Category::create($request->all());

       return redirect()->route('categories.index');
   }

   // Mostrar una categoría específica
   public function show($id)
   {
       $category = Category::findOrFail($id);
       return view('categories.show', compact('category'));
   }

   // Mostrar el formulario para editar una categoría
   public function edit($id)
   {
       $category = Category::findOrFail($id);
       return view('categories.edit', compact('category'));
   }

   // Actualizar una categoría existente
   public function update(Request $request, $id)
   {
       $request->validate([
           'name' => 'required|string|max:255',
           'description' => 'nullable|string',
           'image' => 'nullable|string',
       ]);

       $category = Category::findOrFail($id);
       $category->update($request->all());

       return redirect()->route('categories.index');
   }

   // Eliminar una categoría
   public function destroy($id)
   {
       $category = Category::findOrFail($id);
       $category->delete();

       return redirect()->route('categories.index');
   }
}