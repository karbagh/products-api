<?php

namespace App\Dtoes\Users\Settings;

use App\Dtoes\Dto;

class ChangePasswordRequestDto extends Dto
{
    public function __construct(
        private readonly string $password,
        private readonly string $newPassword,
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
    public function getNewPassword(): string
    {
        return $this->newPassword;
    }

    public function toArray(): array
    {
        return [
            'password' => $this->getPassword(),
            'newPassword' => $this->getNewPassword(),
        ];
    }
}
