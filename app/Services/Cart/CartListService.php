<?php

namespace App\Services\Cart;

use App\Dtoes\Cart\AddToCartRequestDto;
use App\Dtoes\Cart\ChangeCountInCartCartRequestDto;
use App\Dtoes\Cart\ReduceFromCartRequestDto;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Carts\CartListRepository;
use App\Repositories\Devices\DeviceRepository;
use App\Repositories\Products\ProductRepository;
use Exception;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class CartListService
{
    public function __construct(
        private readonly CartListRepository $repository,
        private readonly ProductRepository  $productRepository,
    )
    {
    }

    /**
     * @throws Exception
     */
    public function getByBranchId(string $ip): Cart
    {
        $user = auth()->user();

        $cart = $this->repository->getWithProductDetails(
            $ip,
            $user,
        );

        return $cart ?: $this->repository->createCart($ip, $user);
    }

    public function addToCart(AddToCartRequestDto $dto): Cart
    {
        return $this->repository->createCartAndInsertItem(
            $dto->getIp(),
            $this->productRepository->getByUuid($dto->getUuid()),
            $dto->getCount(),
            $dto->getUser(),
        );
    }

    public function reduceFromCart(ReduceFromCartRequestDto $dto): Cart
    {
        return $this->repository->reduceProductFromCart(
            $dto->getIp(),
            $this->productRepository->getByUuid($dto->getUuid()),
            $dto->getCount(),
            $dto->getUser(),
        );
    }

    public function changeCountInCart(ChangeCountInCartCartRequestDto $dto): Cart
    {
        return $this->repository->changeCountInCart(
            $dto->getIp(),
            $this->productRepository->getByUuid($dto->getUuid()),
            $dto->getCount(),
            $dto->getUser(),
        );
    }

    /**
     * @throws Exception
     */
    public function clear(string $ip): string
    {
        try {
            $this->repository->clear(
                $ip,
                auth()->user(),
            );

            return trans('cart.clear.success');
        } catch (Exception $e) {
            throw new $e(trans('cart.clear.failed'));
        }
    }

    public function removeFromCart(Product $product, string $ip, ?User $user = null): Cart
    {
        return $this->repository->removeItemFromList(
            $ip,
            $product,
            $user,
        );
    }
}
