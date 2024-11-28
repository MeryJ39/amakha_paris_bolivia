<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es necesario, aunque Laravel lo deduce automáticamente
    protected $table = 'roles';

    // Definir los campos que pueden ser asignados masivamente
    protected $fillable = ['name'];

    /**
     * Relación inversa con el modelo User.
     * Un rol puede tener muchos usuarios.
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}