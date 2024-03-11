<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductImages;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;

/**
 * @extends Factory<ProductImages>
 */
class ProductImagesFactory extends Factory
{
    use WithFaker;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::all()->random()->id,
            'src' => storage_path("public/images/products/{$this->faker->randomElement([
                    'product-1.png',
                    'product-2.png',
                    'product-3.svg',
                    'product-4.svg',
                    'product-5.svg',
                    'product-6.svg',
            ])}"),
            'is_main' => $this->faker->boolean,
        ];
    }
}
