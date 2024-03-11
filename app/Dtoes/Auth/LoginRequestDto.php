<?php

namespace App\Dtoes\Auth;

use App\Dtoes\Dto;

class LoginRequestDto extends Dto
{
    public function __construct(
        private readonly string $username,
        private readonly string  $password,
        private readonly string  $recognizer,
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
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getRecognizer(): string
    {
        return $this->recognizer;
    }

    public function toArray(): array
    {
        return [
            'password' => $this->getPassword(),
            'username' => $this->getUsername(),
            'recognizer' => $this->getRecognizer(),
        ];
    }
}
