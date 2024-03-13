<?php

namespace App\Http\Resources\Users;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     title="User Resource",
     *     description="User resource",
     *     schema="UserResourceSchema",
     * 	   @OA\Property(
     *          property="fullName",
     *          type="string",
     *          example="Jsohn Smith"
     *     ),
     * 	   @OA\Property(
     *          property="firstName",
     *          type="string",
     *          example="John"
     *     ),
     * 	   @OA\Property(
     *          property="lastName",
     *          type="string",
     *          example="Smith"
     *     ),
     * 	   @OA\Property(
     *          property="email",
     *          type="string",
     *          example="email@email.com"
     *     ),
     * )
     * */
    public function toArray($request): array
    {
        return [
            'fullName' => $this->fullName,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
        ];
    }
}
