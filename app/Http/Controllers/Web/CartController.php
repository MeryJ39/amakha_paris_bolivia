<?php

namespace App\Http\Controllers\Web;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;




class CartController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware(['auth'])->except(['index']);
    }
    public function index(){
        $userId = Auth::user();
        $products = Product::all();
        return view('Web.Tienda.index',compact('products','userId'));
    }
    public function cart()  {
        $userId = Auth::user();
        $cartCollection = \Cart::session($userId)->getContent();
        return view('Web.Carrito.index',compact('userId','cartCollection'));
    }
    public function remove(Request $request){
        $userId = Auth::user();
        \Cart::session($userId)->remove($request->id);
        return redirect()->route('cart.index')->with('success_msg', 'El articulo ha sido borrado!');
    }
    public function add(Request$request){
        $userId = Auth::user();
        \Cart::session($userId)->add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => array(
                'image' => $request->img,
                'slug' => $request->slug
            )
        ));
        return redirect()->route('cart.index')->with('success_msg', 'El articulo ha sido agregado a su carrito!');
    }
    public function update(Request $request){
        $userId = Auth::user();
        \Cart::session($userId)->update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                ),
        ));
        return redirect()->route('cart.index')->with('success_msg', 'Se ha actualizado el carrito!');
    }
    public function clear(){
        $userId = Auth::user();
        \Cart::session($userId)->clear();
        return redirect()->route('cart.index')->with('success_msg', 'El carrito ha sido borrado con exito!');
    }
}
