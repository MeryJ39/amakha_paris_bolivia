<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
{
    $productos = Product::all();
    return response()->json($productos);
}
    public function search(Request $request)
{
    $query = $request->input('query');
    $products = Product::where('name', 'LIKE', "%{$query}%")
        ->orWhere('description', 'LIKE', "%{$query}%")
        ->get();

    return response()->json(['products' => $products]);
}

public function getProducts()
    {
        $products = Product::all(); // O puedes aplicar paginación
        return response()->json($products);

    }

    public function show($id) {
        $product = Product::find($id);
        $categories = Category::with('subcategories', 'products')->whereNull('parent_id')->get();


        if (!$product) {
            return abort(404); // O maneja el error de otra manera
        }

        return view('Web.Producto.index', compact('product', 'categories'));
    }




}