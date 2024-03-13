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
            ->whereIn('uuid', $uuids)->get();
    }

    public function getProducts(): Builder
    {
        return Product::query();
    }

    public function createProduct(
        string $nameHy,
        string $nameRu,
        string $nameEn,
        string $descriptionHy,
        string $descriptionRu,
        string $descriptionEn,
        float $price,
    ): Product {
        $product = Product::query()->create([
            'price' => $price,
        ]);

        $product->translations()->insert([
            [
                'product_id' => $product->id,
                'name' => $nameHy,
                'description' => $descriptionHy,
                'locale' => 'hy',
            ],
            [
                'product_id' => $product->id,
                'name' => $nameRu,
                'description' => $descriptionRu,
                'locale' => 'ru',
            ],
            [
                'product_id' => $product->id,
                'name' => $nameEn,
                'description' => $descriptionEn,
                'locale' => 'en',
            ],
        ]);

        return $product;
    }

    public function updateProduct(
        Product $product,
        ?string $nameHy,
        ?string $nameRu,
        ?string $nameEn,
        ?string $descriptionHy,
        ?string $descriptionRu,
        ?string $descriptionEn,
        ?float $price,
    ): Product {
        $product->update([
            'price' => $price ?? $product->price,
        ]);

        $product->translations()->delete();
        $product->translations()->insert([
            [
                'product_id' => $product->id,
                'name' => $nameHy ?? $product->translationsColumn('hy', 'name'),
                'description' => $descriptionHy ?? $product->translationsColumn('hy', 'description'),
                'locale' => 'hy',
            ],
            [
                'product_id' => $product->id,
                'name' => $nameRu ?? $product->translationsColumn('ru', 'name'),
                'description' => $descriptionRu ?? $product->translationsColumn('ru', 'description'),
                'locale' => 'ru',
            ],
            [
                'product_id' => $product->id,
                'name' => $nameEn ?? $product->translationsColumn('en', 'name'),
                'description' => $descriptionEn ?? $product->translationsColumn('en', 'description'),
                'locale' => 'en',
            ],
        ]);

        return $product;
    }
}
