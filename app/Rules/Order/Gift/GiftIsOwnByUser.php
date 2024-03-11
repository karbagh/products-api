<?php

namespace App\Rules\Order\Gift;

use App\Models\Gift;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class GiftIsOwnByUser implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return Gift::query()->where('used_by_id', Auth::id())->where('public_id', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('validation.exists');
    }
}
