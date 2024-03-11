<?php

namespace App\Rules\Order\Reverse;

use App\Models\OrderList;
use Illuminate\Contracts\Validation\Rule;

class OrderReverseCountRule implements Rule
{

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return OrderList::find(request()->items[intval($attribute)]['id'])->count >= $value;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return trans('validation.greater.order_item.count');
    }
}
