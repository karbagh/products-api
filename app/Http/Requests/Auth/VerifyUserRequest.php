<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class VerifyUserRequest extends FormRequest
{
    /**
     * @OA\Schema(
     *     title="Verify User Request",
     *     description="Verify User request",
     *     schema="VerifyUserRequestRequestSchema",
     *     required={"email"},
     *      @OA\Property(
     *          property="token",
     *          type="string",
     *          example="hgjhVAFSYITFWU",
     *          title="Verify token of the user."
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
                'max:255',
            ],
        ];
    }
}
