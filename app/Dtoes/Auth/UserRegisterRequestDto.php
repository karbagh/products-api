<?php

namespace App\Dtoes\Auth;

use App\Dtoes\Dto;

class UserRegisterRequestDto extends Dto
{
    public function __construct(
        private readonly string $fullName,
        private readonly ?string $email,
        private readonly string $password,
        private readonly string $recognizer,
    )
    {
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return trim(strtok($this->fullName, ' '));
    }

    public function getLastName(): string
    {
        return trim(strstr($this->fullName, ' '));
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
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
    public function getRecognizer(): string
    {
        return $this->recognizer;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'fullName' => $this->getFullName(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
        ];
    }
}
