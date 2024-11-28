<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'role_id',
        'product_id',
        'discount_amount',
        'start_date',
        'end_date',
        'is_active',
    ];

    /**
     * Relación con el rol
     */
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Relación con el producto
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getIsActiveAttribute($value)
    {
        // Verifica si la fecha de finalización ha pasado
        if (Carbon::now()->gt(Carbon::parse($this->end_date))) {
            return false; // Si la fecha de finalización ha pasado, el descuento ya no está activo
        }

        return $value; // De lo contrario, devuelves el valor original de is_active
    }
}