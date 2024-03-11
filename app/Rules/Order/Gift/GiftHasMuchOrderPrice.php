<?php

namespace App\Rules\Order\Gift;

use App\Models\Order;
use Illuminate\Contracts\Validation\Rule;

class GiftHasMuchOrderPrice implements Rule
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
        return floatval(request()->order->total) >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('validation.greater.order.price');
    }
}
