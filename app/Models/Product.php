<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Translations\HasTranslation;
use App\Interfaces\Models\TranslationInterface;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use Encore\Admin\Traits\DefaultDatetimeFormat;
use Illuminate\Support\Str;

class Product extends Model implements TranslationInterface
{
    use HasFactory, HasTranslation, SoftDeletes, DefaultDatetimeFormat;

    /**
     * @var array|string[]
     */
    public array $translatable = [
        'name',
        'description',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'price' => 'float',
    ];

    /**
     * @var string[]
     */
    protected $fillable = [
        'uuid',
        'price',
    ];

    /**
     * @return void
     */
    protected static function boot(): void
    {
        static::creating(function (self $product) {
            $product->uuid = Str::uuid();
        });

        parent::boot();
    }

    /**
     * @return string
     */
    public function getTranslationRelation(): string
    {
        return ProductTranslation::class;
    }

    /**
     * @return BelongsToMany
     */
    public function sizes(): BelongsToMany
    {
        return $this->belongsToMany(
            Size::class,
            'products_sizes',
            'product_id',
            'size_id'
        );
    }

    /**
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(ProductImages::class);
    }

    /**
     * @return HasMany
     */
    public function imagesWithoutMain(): HasMany
    {
        return $this->hasMany(ProductImages::class)->where('is_main', false);
    }

    /**
     * @return HasOne
     */
    public function mainImage(): HasOne
    {
        return $this->hasOne(ProductImages::class)->where('is_main', true);
    }

    /**
     * @return string
     */
    public function getImageAttribute(): string
    {
        return $this->mainImage?->src ? url(Storage::url($this->mainImage?->src)) : url('default/product.svg');
    }
}
