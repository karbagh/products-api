<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductTranslation>
 */
class ProductTranslationFactory extends Factory
{
    const TRANSLATIONS = [
        'en' => [
            'Siphon for sink KRONER (KRM)-C965 1 1/4"x32 mm chrome (CV022947)',
            'Screw KRONER (KRS)-C265 1 1/4"x32 mm chrome (CV022947)',
            'Paint latex SHEN L, 15 l',
            'Plasterboard standard 2400x1200x9.5mm, KNAUF',
            'Profile F-47, thickness 0.4mm, NARSAN, 4m',
            'Insulation Tape VINI TAPE, Black, 3/4"x10Yds',
            'Copper wire 2*2.5mm, IN-VI',
            'Kitchen faucet Kuchinox',
        ],
        'hy' => [
            'Սիֆոն լվացարանի համար KRONER (KRM)-C965 1 1/4"x32 մմ քրոմ (CV022947)',
            'Պտուտակ KRONER (KRS)-C265 1 1/4"x32 մմ քրոմ (CV022947)',
            'Ներկ լատեքսային SHEN L, 15լ',
            'Գիպսաստվարաթուղթ ստանդարտ 2400x1200х9.5մմ, KNAUF',
            'Պրոֆիլ F-47, հաստությունը 0.4մմ, ՆԱՐՍԱՆ, 4մ',
            'Մեկուսիչ ժապավեն VINI TAPE, սև, 3/4"x10Yds',
            'Պղնձե հաղորդալար 2*2.5մմ, ԻՆ-ՎԻ',
            'Խոհանոցային ծորակ Kuchinox',
        ],
        'ru' => [
            'Сифон для раковины KRONER (KRM)-C965 1 1/4"x32 мм хром (CV022947)',
            'Винт KRONER (KRS)-C265 1 1/4"x32 мм хром (CV022947)',
            'Краска латексная SHEN L, 15 л',
            'Гипсокартон стандарт 2400х1200х9,5мм, КНАУФ',
            'Профиль Ф-47, толщина 0,4мм, НАРСАН, 4м',
            'Изоляционная лента VINI TAPE, черная, 3/4 дюйма x 10 ярдов',
            'Медный провод 2*2,5мм, ИН-ВИ',
            'Смеситель для кухни Kuchinox',
        ],
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $locale = $this->faker->randomElement(['en', 'hy', 'ru']);

        return [
            'product_id' => Product::all()->random()->id,
            'name' => $this->faker->randomElement(self::TRANSLATIONS[$locale]),
            'description' => $this->faker->realText,
            'locale' => $locale,
        ];
    }
}
