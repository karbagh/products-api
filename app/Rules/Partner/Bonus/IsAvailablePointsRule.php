<?php

namespace App\Rules\Partner\Bonus;

use Illuminate\Contracts\Validation\Rule;

class IsAvailablePointsRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return auth()->user()->partner->accumulated_points >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.bonuses.points.available.false');
    }
}
