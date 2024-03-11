<?php

namespace Database\Seeders;

use App\Models\CategoryTranslation;
use App\Models\Product;
use App\Models\ProductImages;
use App\Models\ProductTranslation;
use Database\Factories\CategoryTranslationFactory;
use Database\Factories\ProductTranslationFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Product::factory(50)->create()->each(function ($product) {
            $images = ProductImages::factory(5)->create(['product_id' => $product->id])->each(function ($image, $id) {
                if (!$id) {
                    $image->is_main = true;
                }
            });
            $product->images()->saveMany($images);

            $locales = ['en', 'hy', 'ru'];
            $translations = ProductTranslation::factory(3)
                ->create()
                ->each(function ($translation, $locale) use ($locales) {
                    $translation->locale = $locales[$locale];
                    $translation->name = fake()->randomElement(
                        ProductTranslationFactory::TRANSLATIONS[$locales[$locale]]
                    );
                });
            $product->translations()->saveMany($translations);
        });
    }
}
