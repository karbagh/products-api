<?php

namespace App\Repositories\Products;

use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\User;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection as SupportCollection;
use Illuminate\Support\Facades\DB;

class ProductRepository extends AbstractRepository
{
    public function getByUuid(string $uuid): Product
    {
        return Product::query()->where('uuid', $uuid)->firstOrFail();
    }

    public function getByUuids(array $uuids): Collection
    {
        return Product::query()
            ->where('count', '>', 0)
            ->where('is_active', 1)
            ->whereIn('uuid', $uuids)->get();
    }

    public function getProducts(): Builder
    {
        return Product::query()->where('count', '>', 0);
    }
}
