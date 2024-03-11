<?php

namespace App\Http\Requests\Auth\Login;

use Illuminate\Foundation\Http\FormRequest;

class DeviceLoginRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     title="Device Login",
     *     description="Device Login request",
     *     schema="DeviceLoginRequestSchema",
     *     required={"uuid", "count"},
     * 	   @OA\Property(
     *          property="username",
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
            'username' => [
                'required',
                'string',
                'exists:devices,public_id',
            ],
            'password' => [
                'required',
                'string',
            ],
        ];
    }

    /**
     * @OA\Schema(
     *     title="Device Login Messages",
     *     description="Device Login validation messages",
     *     schema="DeviceLoginRequestMessagesSchema",
     *     	   @OA\Property(
     *              property="username",
     *              type="string",
     *              example={"The username field is required.", "The password should be a string."},
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
            'username.exists' => trans('validation.username.exists.false'),
        ];
    }
}
