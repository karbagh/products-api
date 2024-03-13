<?php

namespace App\Dtoes\Users\Settings;

use App\Dtoes\Dto;

class UpdateUsersSettingsRequestDto extends Dto
{
    public function __construct(
        private readonly ?string $name,
        private readonly ?string $email,
        private readonly ?string $phone,
    )
    {
    }

    /**
     * @return string
     */
    public function getFirstName(): ?string
    {
        return $this->getName() ? trim(strtok($this->getName(), ' ')) : $this->getName();
    }

    public function getLastName(): ?string
    {
        return $this->getName() ? trim(strstr($this->getName(), ' ')) : $this->getName();
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function toArray(): array
    {
        return [
            'firstName' => $this->getEmail(),
            'lastName' => $this->getEmail(),
            'email' => $this->getEmail(),
        ];
    }
}
