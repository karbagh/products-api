<?php

namespace App\Dtoes\Cart;

use App\Dtoes\Dto;
use App\Models\User;

class ChangeCountInCartCartRequestDto extends Dto
{
    public function __construct(
        private string $ip,
        private string $uuid,
        private float $count,
        private ?User $user,
    )
    {
    }

    /**
     * @return string
     */
    public function getIp(): string
    {
        return $this->ip;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return float
     */
    public function getCount(): float
    {
        return $this->count;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    public function toArray(): array
    {
        return [
            'uuid' => $this->uuid,
            'count' => $this->count,
        ];
    }
}
