<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductManagementController extends Controller
{
     // Mostrar todos los productos
    public function index()
    {
        $products = Product::paginate(10); // Paginación de 10 productos por página

        return view('admin.products.index', compact('products'));
    }

    // Mostrar el formulario para crear un producto
    public function create()
    {
        $subcategories = Subcategory::all(); // Obtener subcategorías para el select
        return view('admin.products.create', compact('subcategories'));
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $product = new Product($validated);
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Producto creado exitosamente');
    }

    // Mostrar el formulario para editar un producto
    public function edit(Product $product)
    {
        $subcategories = Subcategory::all(); // Obtener subcategorías para el select
        return view('admin.products.edit', compact('product', 'subcategories'));
    }

    // Actualizar un producto existente
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $product->update($validated);

        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe
            if ($product->image) {
                Storage::delete('public/' . $product->image);
            }
            // Subir nueva imagen
            $imagePath = $request->file('image')->store('product_images', 'public');
            $product->image = $imagePath;
        }

        return redirect()->route('admin.products.index')->with('success', 'Producto actualizado exitosamente');
    }

    // Eliminar un producto
    public function destroy(Product $product)
    {
        // Eliminar imagen relacionada
        if ($product->image) {
            Storage::delete('public/' . $product->image);
        }

        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Producto eliminado exitosamente');
    }

    // Actualizar el stock de un producto
    public function updateStock(Request $request, Product $product)
    {
        $request->validate([
            'stock' => 'required|integer',
        ]);

        $product->stock = $request->stock;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Stock actualizado exitosamente');
    }
}