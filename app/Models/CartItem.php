<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class CartItem extends Model
{
    use HasFactory;

    // Tabla asociada (si es diferente a 'cart_items')
    protected $table = 'cart_items';

    // Campos que pueden ser asignados en masa
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'unit_discount',
    ];

    /**
     * Relación con el modelo User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el modelo Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Obtener el total con descuento aplicado al cart item
     */
    public function getTotalWithDiscountAttribute()
    {
        return ($this->price - $this->unit_discount) * $this->quantity;
    }

    /**
     * Obtener el precio total antes de descuentos
     */
    public function getTotalPriceAttribute()
    {
        return $this->price * $this->quantity;
    }

    /**
     * Actualizar la cantidad del ítem en el carrito
     */
    public function updateQuantity(int $quantity)
    {
        if ($quantity < 1) {
            Log::debug('Quantity is less than 1, returning early.');
            return false;
        }

        // Actualizamos la cantidad
        $this->update(['quantity' => $quantity]);

        Log::debug('CartItem quantity updated: ' . $this->quantity);

        return true;
    }

    /**
     * Eliminar el ítem del carrito
     */
    public function removeItem()
    {
        // Eliminamos el ítem
        $this->delete();

        Log::debug('CartItem deleted: ' . $this->id);
        return true;
    }
}