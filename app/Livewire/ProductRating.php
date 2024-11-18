<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProductRating extends Component
{
    public $product; // El producto que se va a calificar
    public $rating = 0; // La calificación seleccionada por el usuario
    public $userRating; // La calificación actual del usuario

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->userRating = $product->ratings()->where('user_id', Auth::id())->first();
        if ($this->userRating) {
            $this->rating = $this->userRating->rating; // Si el usuario ya ha calificado, carga su calificación
        }
    }

    public function rate($rating)
    {
        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            // Redirigir al login si no está autenticado
            return redirect()->route('login');
        }

        // Si el usuario ya ha calificado, actualizar la calificación
        if ($this->userRating) {
            $this->userRating->update(['rating' => $rating]);
        } else {
            // Si el usuario no ha calificado, crear una nueva calificación
            $this->product->ratings()->create([
                'user_id' => Auth::id(), // Guardar el ID del usuario autenticado
                'rating' => $rating,
            ]);
        }

        $this->rating = $rating; // Actualizar la calificación en la interfaz
    }

    public function render()
    {
        return view('livewire.product-rating');
    }
}