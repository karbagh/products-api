<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Cart::factory(5)->create()->each(function (Cart $cart) {
            $products = CartList::factory(10)->create(['cart_id' => $cart->id]);
            $cart->products()->saveMany($products);
        });
    }
}
