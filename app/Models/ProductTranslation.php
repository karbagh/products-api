<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTranslation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'description',
        'locale'
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saved(function (self $productTranslation) {
            self::saveKeywords($productTranslation);
        });
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    private static function saveKeywords(self $productTranslation): void
    {
        $categoryTranslation = $productTranslation->product?->category?->translations()->first();

        $keywords = array_map(function ($item) use ($productTranslation) {
            if (isset($item)) {
                return [
                    'keyword' => $item,
                    'product_id' => $productTranslation->product->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }, array_filter(array_unique(array_merge(
            [$productTranslation->product?->article],
            explode(' ', $productTranslation->name),
            explode(' ', $categoryTranslation?->name),
        ))));

        $productTranslation->product->keywords()
            ->whereIn('keyword', array_column($keywords, 'keyword'))
            ->delete();

        $productTranslation->product->keywords()->upsert($keywords, ['keyword', 'product_id']);
    }
}
