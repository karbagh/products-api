<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     title="Reset Password request",
     *     description="Reset Password request",
     *     schema="ResetPasswordRequestSchema",
     *     required={"password"},
     *      @OA\Property(
     *          property="token",
     *          type="string",
     *          example="fjsdhkbUYT654321gjhasdagdsjh",
     *          title="Token from email message.",
     *     ),
     *      @OA\Property(
     *          property="password",
     *          type="string",
     *          example="password",
     *          title="Password of the user.",
     *     ),
     *      @OA\Property(
     *          property="passwordConfirmation",
     *          type="string",
     *          example="password",
     *          title="Password Confirmation of the user.",
     *     ),
     * )
     *
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => [
                'required',
                'string',
                'min:60',
                'exists:password_resets,token',
            ],
            'password' => [
                'required',
                'string',
                'min:6',
                'same:passwordConfirmation',
            ],
            'passwordConfirmation' => [
                'required',
                'string',
                'min:6',
            ],
        ];
    }

    /**
     * @OA\Schema(
     *     title="Reset Password",
     *     description="Reset Password validation messages",
     *     schema="ResetPasswordRequestMessagesSchema",
     *      @OA\Property(
     *          property="token",
     *          type="string",
     *          example={"The token field is required.", "The token should be string."}
     *      ),
     *      @OA\Property(
     *          property="password",
     *          type="string",
     *          example={"The password field is required.", "The password should be string."}
     *      ),
     *      @OA\Property(
     *          property="passwordConfirmation",
     *          type="string",
     *          example={"The passwordConfirmation field is required.", "The passwordConfirmation should be string."}
     *      ),
     * )
     *
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function messages(): array
    {
        return parent::messages();
    }
}
