<?php

namespace App\Repositories\Products\Ratings;

use App\Models\Product;
use App\Models\ProductRating;
use App\Models\User;

class ProductRatingRepository
{
    public function create(
        float $rate,
        Product $product,
        string $fullName,
        string $address,
        string $phone,
        ?string $comment,
    ): ProductRating {
        return $product->rates()->create([
            'rate' => $rate,
            'full_name' => $fullName,
            'address' => $address,
            'phone' => $phone,
            'comment' => $comment,
        ]);
    }
}
