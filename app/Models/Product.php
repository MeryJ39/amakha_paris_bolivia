<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'stock', 'image', 'subcategory_id'];

    // Relación con la subcategoría
    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    // Relación con las calificaciones
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Obtener el promedio de calificación de un producto
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}