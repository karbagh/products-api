<?php

namespace App\Enums\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

enum Trend: string
{
    case NEWEST = 'newest';
    case POPULAR = 'popular';
    case DISCOUNTED = 'discounted';

    public function products(): Builder
    {
        return match ($this) {
            self::NEWEST => Product::query()->newest(),
            self::POPULAR => Product::query()->popular(),
            self::DISCOUNTED => Product::query()->discounted(),
        };
    }
}
