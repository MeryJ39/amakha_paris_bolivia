<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'address_id',
        'payment_method',
        'total_amount',
        'status'
    ];

    /**
     * Relación con el modelo User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relación con el modelo Address.
     */
    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    /**
     * Relación con el modelo OrderItem.
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
