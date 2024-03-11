<?php

namespace App\Dtoes\Auth;

use App\Dtoes\Dto;
use App\Http\Resources\Users\UserResource;
use App\Models\User;

class UserRegisterResponseDto extends Dto
{
    public function __construct(
        private readonly string $token,
        private readonly User $user,
    )
    {
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    public function toArray(): array
    {
        return [
            'token' => $this->getToken(),
            'user' => UserResource::make($this->getUser()),
        ];
    }
}
