<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Mostrar todos los productos
    public function index()
    {
        $products = Product::with('subcategory')->get();
        return view('products.index', compact('products'));
    }

    // Mostrar el formulario para crear un nuevo producto
    public function create()
    {
        $subcategories = Subcategory::all();
        return view('products.create', compact('subcategories'));
    }

    // Almacenar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        Product::create($request->all());

        return redirect()->route('products.index');
    }

    // Mostrar un producto específico
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    // Mostrar el formulario para editar un producto
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $subcategories = Subcategory::all();
        return view('products.edit', compact('product', 'subcategories'));
    }

    // Actualizar un producto existente
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'subcategory_id' => 'required|exists:subcategories,id',
        ]);

        $product = Product::findOrFail($id);
        $product->update($request->all());

        return redirect()->route('products.index');
    }

    // Eliminar un producto
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return redirect()->route('products.index');
    }

    public function showProducts()
{
    $products = Product::with('ratings')->get(); // Obtener productos con sus calificaciones
    return view('products.index', compact('products'));
}

// Función para mostrar los detalles del producto por su slug
public function productDetails($slug)
{
    // Buscar el producto por su slug
    $product = Product::where('slug', $slug)->firstOrFail();

    // Pasar el producto a la vista 'shop.productdetails'
    return view('shop.productdetails', compact('product'));
}
}