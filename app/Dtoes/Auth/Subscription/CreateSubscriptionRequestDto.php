<?php

namespace App\Dtoes\Auth\Subscription;

use App\Dtoes\Dto;

class CreateSubscriptionRequestDto extends Dto
{
    public function __construct(
        private readonly string $email,
        private readonly string $ip,
    )
    {
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    public function toArray(): array
    {
        return [
            'ip' => $this->getIp(),
            'email' => $this->getEmail(),
        ];
    }
}
