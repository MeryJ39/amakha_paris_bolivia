<?php

namespace App\Livewire;
use App\Models\Product;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class SearchBar extends Component
{
    public $searchQuery = '';
    public $mobile = false;
    public $searchResults = [];

    public function mount($mobile = false)
    {
        $this->mobile = $mobile;
    }

    public function updatedSearchQuery()
    {
         if (strlen($this->searchQuery) >= 3) {
             try {
                Log::info('Ejecutando consulta de búsqueda para: ' . $this->searchQuery); // Add this line
                $this->searchResults = Product::where('name', 'like', '%' . $this->searchQuery . '%')
                    //->orWhere('description', 'like', '%' . $this->searchQuery . '%') // Comment this line
                    ->with('subcategory') // Asegurarnos de que la relación se carga
                    ->get();
                Log::info('Resultados de la búsqueda: ' . json_encode($this->searchResults));
            } catch (\Exception $e) {
                Log::error('Error en la consulta de búsqueda: ' . $e->getMessage());
                $this->searchResults = []; // Limpiar los resultados en caso de error
            }
        } else {
            $this->searchResults = [];
        }
    }

    public function render()
    {
        Log::info('Renderizando componente de búsqueda'); // Add this line
        return view('livewire.search-bar');
    }
}
