<?php

namespace App\Http\Requests\User\Settings;

use App\Rules\Phone\ArmenianPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSettingsRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     title="Update User Settings",
     *     description="User Settings update request",
     *     schema="UpdateUserSettingsRequestSchema",
     * 	   @OA\Property(
     *          property="name",
     *          type="string",
     *          example="Name Surname",
     *          title="Name of the user."
     *     ),
     *     @OA\Property(
     *          property="email",
     *          type="string",
     *          example="email@email.com",
     *          title="User Email."
     *     ),
     *     @OA\Property(
     *          property="phone",
     *          type="string",
     *          example="+37400000000",
     *          title="Phone of the user."
     *     ),
     * )
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'sometimes',
                'string',
                'max:255',
            ],
            'email' => [
                'sometimes',
                'string',
                'email',
                'max:255',
                'unique:users,email',
            ],
            'phone' => [
                'sometimes',
                'unique:users,phone',
                'string',
                'min:12',
                'phone_number',
                new ArmenianPhoneNumberRule(),
            ],
        ];
    }

    /**
     * @OA\Schema(
     *     title="User Update Settings Messages",
     *     description="User Update Settings validation messages",
     *     schema="UpdateUserSettingsRequestMessagesSchema",
     *     	   @OA\Property(
     *              property="name",
     *              type="string",
     *              example={"The name should be a string."},
     *         ),
     *         @OA\Property(
     *              property="email",
     *              type="string",
     *              example={"The password should be a string."},
     *         ),
     *     	   @OA\Property(
     *              property="phone",
     *              type="string",
     *              example={"The password should be a string."}
     *          )
     *     ),
     * )
     * @return array
     */
    public function messages(): array
    {
        return parent::messages();
    }
}
