<?php

namespace App\Dtoes\Product\PriceRequest;

use App\Dtoes\Dto;
use App\Models\User;

class CreatePriceRequestRequestDto extends Dto
{
    public function __construct(
        private readonly User   $user,
        private readonly array $items,
    )
    {
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function toArray(): array
    {
        return [
            'user' => $this->getUser(),
            'items' => $this->getItems(),
        ];
    }
}
