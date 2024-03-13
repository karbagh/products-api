<?php

namespace App\Dtoes\Product;

use App\Dtoes\Dto;

class CreateProductRequestDto extends Dto
{
    public function __construct(
        private readonly string $nameHy,
        private readonly string $nameRu,
        private readonly string $nameEn,
        private readonly string $descriptionHy,
        private readonly string $descriptionRu,
        private readonly string $descriptionEn,
        private readonly float  $price,
    )
    {
    }

    public function getNameHy(): string
    {
        return $this->nameHy;
    }

    public function getNameRu(): string
    {
        return $this->nameRu;
    }

    public function getNameEn(): string
    {
        return $this->nameEn;
    }

    public function getDescriptionHy(): string
    {
        return $this->descriptionHy;
    }

    public function getDescriptionRu(): string
    {
        return $this->descriptionRu;
    }

    public function getDescriptionEn(): string
    {
        return $this->descriptionEn;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function toArray(): array
    {
        return [
            'nameHy' => $this->getNameHy(),
            'nameRu' => $this->getNameRu(),
            'nameEn' => $this->getNameEn(),
            'descriptionHy' => $this->getDescriptionHy(),
            'descriptionRu' => $this->getDescriptionRu(),
            'descriptionEn' => $this->getDescriptionEn(),
            'price' => $this->getPrice(),
        ];
    }
}
