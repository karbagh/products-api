<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordEmailRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     title="Reset Password Email",
     *     description="Reset Password Email request",
     *     schema="ResetPasswordEmailRequestSchema",
     *     required={"email"},
     *      @OA\Property(
     *          property="email",
     *          type="string",
     *          example="example@mail.com",
     *          title="Email of the user."
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
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'exists:users,email',
            ],
        ];
    }
    /**
     * @OA\Schema(
     *     title="Reset Password Email validation",
     *     description="Reset Password Email validation messages",
     *     schema="ResetPasswordEmailRequestMessagesSchema",
     *      @OA\Property(
     *        property="email",
     *        type="string",
     *        example={"The email is required.", "The email should be string.", "The email is invalid."},
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
