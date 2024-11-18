<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class CardProduct extends Component
{
    public $productId;  // ID del producto a mostrar
    public $product;    // El producto que se cargará

    // Cuando el componente se monta, cargar el producto
    public function mount($productId)
    {
        $this->productId = $productId;
        $this->product = Product::findOrFail($this->productId); // Obtener el producto por ID
    }

    public function render()
    {
        return view('livewire.card-product');
    }
}