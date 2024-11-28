<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Campos que pueden ser asignados masivamente, eliminando 'image'
    protected $fillable = ['name', 'description'];

    // Relación con Subcategorías
    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }
}