<?php

namespace App\Http\Requests\Cart;

use App\Rules\Cart\CountNumberAndTypeRule;
use App\Rules\Cart\NotAvailableCountRule;
use Illuminate\Foundation\Http\FormRequest;

class ChangeCountInCartRequest extends FormRequest
{

    /**
     * @OA\Schema(
     *     title="Change Count in cart",
     *     description="Change count request",
     *     schema="ChangeCountInCartRequestSchema",
     *     required={"id", "count"},
     * 	   @OA\Property(
     *          property="id",
     *          type="string",
     *          example="0178bfed-17d5-34f8-88cf-299b3281a2c1",
     *          title="UUID of the product."
     *     ),
     * 	   @OA\Property(
     *          property="count",
     *          type="number",
     *          example="1"
     *     ),
     * )
     *
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'id' => [
                'required',
                'string',
                'exists:products,uuid',
            ],
            'count' => [
                'required',
                'numeric',
                new CountNumberAndTypeRule,
            ],
        ];
    }

    /**
     * @OA\Schema(
     *     title="Change count in cart messages",
     *     description="Change count in cart validation messages",
     *     schema="ChangeCountInCartRequestMessagesSchema",
     * 	   @OA\Property(
     *          property="id",
     *          type="string",
     *          example={"The uuid field is required.", "The selected uuid is invalid."},
     *     ),
     * 	   @OA\Property(
     *          property="count",
     *                 type="string",
     *                 example={"The count field is required.", "The count should be a numeric."}
     *          )
     *     ),
     * )
     *
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function messages(): array
    {
        return parent::messages(); // TODO: Change the autogenerated stub
    }
}
