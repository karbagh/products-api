<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RestoreAccountRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     title="Restore Account",
     *     description="Restore Account request",
     *     schema="RestoreAccountRequestSchema",
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
     *     title="Restore Account validation",
     *     description="Restore Account validation messages",
     *     schema="RestoreAccountRequestMessagesSchema",
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
