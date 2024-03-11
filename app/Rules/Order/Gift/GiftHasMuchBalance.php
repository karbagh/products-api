<?php

namespace App\Rules\Order\Gift;

use App\Models\Gift;
use Illuminate\Contracts\Validation\Rule;

class GiftHasMuchBalance implements Rule
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
        $gift = Gift::query()->where('public_id', request()->gift['id'])->first();

        return floatval($gift?->balance) >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('validation.greater.gift.balance');
    }
}
