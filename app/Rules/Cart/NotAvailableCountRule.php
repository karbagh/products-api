<?php

namespace App\Rules\Cart;

use App\Enums\Repository\Repository;
use Illuminate\Contracts\Validation\Rule;

class NotAvailableCountRule implements Rule
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
    public function passes($attribute, $value)
    {
        $productRepository = Repository::from('product')->getRepository();
        $product = $productRepository->getByUuid(request()->id);
        return intval($product->count);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return trans('validation.cart.count.available.false');
    }
}
