<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


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
            'name' => 'required|string|max:255|unique:products,name',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'description' => 'nullable|string',
            'subcategory_id' => 'required|exists:subcategories,id',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'discount' => 'nullable|numeric|min:0',  // Validación para el descuento

        ], [
            'name.unique' => 'El Nombre del Producto ya existe.',
            'price.required' => 'El Precio es requerido.',
            'stock.required' => 'El Stock es requerido.',
            'subcategory_id.required' => 'La Subcategoría es requerida.',
        ]);

        $product = new Product($validated);

        // Determinar si el descuento es porcentual
        if ($request->has('discount_type') && $request->discount_type == 'percentage') {
            // Si es un porcentaje, calculamos el descuento en Bs
            $percentageDiscount = ($product->price * $request->discount) / 100;
            $product->discount = $percentageDiscount; // Asignamos el descuento calculado en Bs
        } else {
            // Si no es un porcentaje, usamos el descuento tal cual como Bs
            $product->discount = $request->discount ?? 0; // Si no se ingresa nada, asignamos 0
        }


        // Subir la imagen a Cloudinary si existe
        if ($request->hasFile('image')) {
            // Subir imagen a Cloudinary
            $image = $request->file('image');
            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'products',  // Puedes especificar un folder, por ejemplo, 'products'
            ]);

            // Obtener la URL de la imagen subida
            $product->image = $uploadedImage->getSecurePath();
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
            'discount' => 'nullable|numeric|min:0',  // Validación para el descuento

        ]);

        // Si se seleccionó porcentaje
        if ($request->has('discount_type') && $request->discount_type == 'percentage') {
            // Si es un porcentaje, calculamos el descuento en Bs
            $percentageDiscount = ($product->price * $request->discount) / 100;
            $product->discount = $percentageDiscount; // Asignamos el descuento calculado en Bs
        } else {
            // Si no es un porcentaje, usamos el descuento tal cual como Bs
            $product->discount = $request->discount ?? 0; // Si no se ingresa nada, asignamos 0
        }

        $product->update($validated);




        // Subir la nueva imagen a Cloudinary si se proporciona una nueva
        if ($request->hasFile('image')) {
            // Eliminar la imagen anterior si existe en Cloudinary
            if ($product->image) {
                $publicId = basename($product->image, '.' . pathinfo($product->image, PATHINFO_EXTENSION)); // Extraer el public_id
                Cloudinary::destroy($publicId);  // Eliminar la imagen de Cloudinary
            }

            // Subir nueva imagen a Cloudinary
            $image = $request->file('image');
            $uploadedImage = Cloudinary::upload($image->getRealPath(), [
                'folder' => 'products',  // Puedes especificar un folder
            ]);

            // Actualizar el producto con la nueva URL de la imagen
            $product->image = $uploadedImage->getSecurePath();
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