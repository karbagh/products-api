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
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
