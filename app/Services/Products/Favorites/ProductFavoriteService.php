<?php

namespace App\Services\Products\Favorites;

use App\Dtoes\Product\Favorites\CreateFavoritesProductsRequestDto;
use App\Models\Product;
use App\Models\User;
use App\Repositories\User\UserRepository;

class ProductFavoriteService
{
    public function __construct(
        private readonly UserRepository $userRepository
    )
    {
    }

    public function remove(User $user, Product $product): void
    {
        $this->userRepository->removeFromFavorites($user, $product->id);
    }

    public function create(CreateFavoritesProductsRequestDto $dto): User
    {
        return $this->userRepository->addFavorites($dto->getUser(), $dto->getProductCollection());
    }
}
