<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function categories(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getDiscountAttribute()
{
    return $this->price - $this->precio_venta;
}

public function getDiscountPercentageAttribute()
{
    return $this->price > 0 ? ($this->getDiscountAttribute() / $this->price) * 100 : 0;
}

}
