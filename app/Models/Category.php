<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image']; // Campos que pueden ser asignados masivamente

    // Relación con Subcategorías
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}