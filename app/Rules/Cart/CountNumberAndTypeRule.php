<?php

namespace App\Rules\Cart;

use App\Enums\Repository\Repository;
use Illuminate\Contracts\Validation\Rule;

class CountNumberAndTypeRule implements Rule
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
        $productRepository = Repository::from('product')->getRepository();
        $product = $productRepository->getByUuid(request()->id);

        if ($product->unit->nativeType === 'double') {
            return floatval($value);
        }
        return is_int($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.cart.count.separable');
    }
}
