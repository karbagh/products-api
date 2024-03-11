<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'ip',
        'user_id',
    ];

    public function products(): HasMany
    {
        return $this->hasMany(CartList::class);
    }

    public function getDiscountAttribute(): float
    {
        $discount = 0;
        $this->products()->each(function ($item) use (&$discount) {
            $discount += (($item->product->price / 100) * $item->product->discount) * $item->count;
        });
        return round($discount, 3);
    }

    public function getSubtotalAttribute(): float
    {
        return round($this->total + $this->discount, 3);
    }

    public function getTotalAttribute(): float
    {
        return round($this->products()->sum('total'), 3);
    }

    public function scopeWithProductDetails(): Builder
    {
        return $this->with(['products' => function ($q) {
            return $q->select(['id', 'product_id', 'cart_id', 'count', 'total'])
                ->with(['product' => function ($q) {
                    $q->with(['mainImage:id,product_id,src']);
                }]);
        }])->withCount('products');
    }

    public function scopeLoadProductDetails(): Cart
    {
        return $this->load(['products' => function ($q) {
            return $q->select(['id', 'product_id', 'cart_id', 'count', 'total'])
                ->with(['product' => function ($q) {
                    $q->with(['mainImage:id,product_id,src']);
                }]);
        }])->loadCount('products');
    }
}
