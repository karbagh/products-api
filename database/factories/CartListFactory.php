<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartList>
 */
class CartListFactory extends Factory
{
    use WithFaker;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = Product::all()->random();
        $count = $this->faker->numberBetween(5, 20);

        return [
            'product_id' => $product->id,
            'count' => $count,
            'total' => $product->price * $count,
        ];
    }
}
