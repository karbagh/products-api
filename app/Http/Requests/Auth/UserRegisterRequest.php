<?php

namespace App\Http\Requests\Auth;

use App\Rules\Phone\ArmenianPhoneNumberRule;
use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     title="Sign Up User",
     *     description="Sign Up User request",
     *     schema="UserRegisterRequestSchema",
     *     required={"fullName", "email", "phone", "password"},
     *      @OA\Property(
     *          property="fullName",
     *          type="string",
     *          example="Full Name",
     *          title="First Name of the user."
     *     ),
     *      @OA\Property(
     *          property="email",
     *          type="string",
     *          example="example@mail.com",
     *          title="Email of the user."
     *     ),
     *      @OA\Property(
     *          property="phone",
     *          type="string",
     *          example="+37400000000",
     *          title="Phone of the user.",
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
    public function rules(): array
    {
        return [
            'fullName' => [
                'required',
                'string',
                'max:255',
            ],
            'phone' => [
                'sometimes',
                'string',
                'unique:users,phone',
                'min:12',
                'phone_number',
                new ArmenianPhoneNumberRule(),
            ],
            'email' => [
                'required',
                'string',
                'email',
                'unique:users,email',
                'max:255',
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
     *     title="User Registration validation",
     *     description="User Registration validation messages",
     *     schema="UserRegisterRequestMessagesSchema",
     *      @OA\Property(
     *          property="fullName",
     *          type="string",
     *          example={"The fullName field is required.", "The fullName should be string."}
     *      ),
     *      @OA\Property(
     *        property="email",
     *        type="string",
     *        example={"The email should be string.", "The email is invalid."},
     *      ),
     *      @OA\Property(
     *          property="phone",
     *          type="string",
     *          example={"The phone field is required.", "The phone should be string."}
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
