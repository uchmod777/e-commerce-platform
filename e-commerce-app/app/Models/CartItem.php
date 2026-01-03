<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function subtotal(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->price * $this->quantity,
        );
    }

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
