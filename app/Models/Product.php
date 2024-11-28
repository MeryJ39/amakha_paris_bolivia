<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    // Campos que pueden ser asignados masivamente
    protected $fillable = ['name', 'description', 'price', 'stock', 'image', 'subcategory_id', 'slug'];

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

    // Generar el slug automáticamente antes de guardar el producto
    protected static function booted()
    {
        static::creating(function ($product) {
            $product->slug = Str::slug($product->name); // Genera el slug a partir del nombre
        });

        static::updating(function ($product) {
            $product->slug = Str::slug($product->name); // Actualiza el slug si el nombre cambia
        });
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}