<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

        protected $fillable = [
        'name',
        'sku',
        'price',
        'quantity',
    ];

    public function orderItems(){
        return $this->hasMany(OrderItem::class);
    }

    public function withOrderItems(){
        return $this->with('orderItems');
    }
}
