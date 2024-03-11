<?php

namespace App\Dtoes\Product;

use App\Dtoes\Dto;
use App\Models\Product;
use App\Models\User;

class ProductRatingDto extends Dto
{
    public function __construct(
        private readonly Product $product,
        private readonly float $rate,
        private readonly string $fullName,
        private readonly string $address,
        private readonly string $phone,
        private readonly ?string $comment = null,
    )
    {
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        return $this->product;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @return string|null
     */
    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function toArray(): array
    {
        return [
            'product' => $this->getProduct(),
            'rate' => $this->getRate(),
            'fullName' => $this->getFullName(),
            'address' => $this->getAddress(),
            'phone' => $this->getPhone(),
            'comment' => $this->getComment(),
        ];
    }
}
