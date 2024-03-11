<?php

namespace App\Http\Requests\Auth\Login;

use App\Rules\Phone\ArmenianPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     title="User Login",
     *     description="User Login request",
     *     schema="UserLoginRequestSchema",
     *     required={"uuid", "count"},
     * 	   @OA\Property(
     *          property="email",
     *          type="string",
     *          example="0178bfed-17d5-34f8-88cf-299b3281a2c1",
     *          title="UUID of the product."
     *     ),
     * 	   @OA\Property(
     *          property="password",
     *          type="number",
     *          example="password"
     *     ),
     * )
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required_without:phone',
                'string',
                'email',
                'exists:users,email',
            ],
            'phone' => [
                'required_without:email',
                'string',
                'exists:users,phone',
                'min:12',
                'phone_number',
                new ArmenianPhoneNumberRule(),
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * @OA\Schema(
     *     title="User Login Messages",
     *     description="User Login validation messages",
     *     schema="UserLoginRequestMessagesSchema",
     *     	   @OA\Property(
     *              property="email",
     *              type="string",
     *              example={"The email field is required.", "The password should be a string."},
     *         ),
     *     	   @OA\Property(
     *              property="password",
     *              type="string",
     *              example={"The password field is required.", "The password should be a string."}
     *          )
     *     ),
     * )
     * @return array
     */
    public function messages(): array
    {
        return [
            'email.exists' => trans('validation.username.exists.false'),
        ];
    }
}
