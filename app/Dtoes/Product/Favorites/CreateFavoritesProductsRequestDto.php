<?php

namespace App\Dtoes\Product\Favorites;

use App\Dtoes\Dto;
use App\Models\User;
use App\Repositories\Products\ProductRepository;
use Illuminate\Database\Eloquent\Collection;

class CreateFavoritesProductsRequestDto extends Dto
{
    private ProductRepository $productRepository;

    public function __construct(
        private readonly User $user,
        private readonly array $products,
    )
    {
        $this->productRepository = new ProductRepository();
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
    public function getProducts(): array
    {
        return $this->products;
    }

    public function getProductCollection(): Collection
    {
        return $this->productRepository->getByUuids($this->getProducts());
    }

    public function toArray(): array
    {
        return [
            'user' => $this->getUser(),
            'products' => $this->getProductCollection(),
        ];
    }
}
