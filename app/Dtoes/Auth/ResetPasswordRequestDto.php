<?php

namespace App\Dtoes\Auth;

use App\Dtoes\Dto;

class ResetPasswordRequestDto extends Dto
{
    public function __construct(
        private readonly string $token,
        private readonly string $password,
    )
    {
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    public function toArray(): array
    {
        return [
            'password' => $this->getPassword(),
            'token' => $this->getToken(),
        ];
    }
}
