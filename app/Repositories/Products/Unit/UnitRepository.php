<?php

namespace App\Repositories\Products\Unit;

use App\Enums\Language\Language;
use App\Models\Unit;
use App\Models\UnitTranslation;
use App\Repositories\AbstractRepository;
use Illuminate\Support\Str;

class UnitRepository extends AbstractRepository
{
    public function createMany(array $unitsCollection)
    {
        $units = UnitTranslation::query()->where('locale', 'hy')
            ->whereIn('name', $unitsCollection)
            ->pluck('unit_id', 'name')->toArray();

        $newUnits = array_values(array_diff($unitsCollection, array_keys($units)));

        $unitsToSave = array_map(function (string $unit) use ($units) {
            return array_map(
                fn($lang) => [
                    'name' => Str::apiTranslate($unit, $lang),
                    'locale' => $lang,
                ],
                Language::toArray()
            );
        }, $newUnits);

        Unit::factory()->count(count($unitsToSave))->create()->each(function($unit, $index) use ($unitsToSave) {
            $unit->translations()->createMany($unitsToSave[$index]);
        });
    }
}
