<?php

namespace App\Http\Requests\Product\PriceRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreatePriceRequestRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'items' => [
                'required',
                'array',
            ],
            'items.*.productId' => [
                'required',
                'string',
                'exists:products,uuid',
            ],
            'items.*.price' => [
                'required',
                'numeric',
            ],
            'items.*.count' => [
                'required',
                'numeric',
            ],
            'items.*.message' => [
                'nullable',
                'string',
            ],
        ];
    }
}
