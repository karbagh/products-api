<?php

namespace App\Services\Products\Ratings;

use App\Dtoes\Product\ProductRatingDto;
use App\Models\ProductRating;
use App\Repositories\Devices\DeviceRepository;
use App\Repositories\Products\Ratings\ProductRatingRepository;
use Exception;
use Symfony\Component\HttpKernel\Exception\ServiceUnavailableHttpException;

class ProductRatingService
{

    public function __construct(
        private ProductRatingRepository $productRatingRepository,
    )
    {
    }

    public function create(ProductRatingDto $dto): ProductRating
    {
        try {
            return $this->productRatingRepository->create(
                $dto->getRate(),
                $dto->getProduct(),
                $dto->getFullName(),
                $dto->getAddress(),
                $dto->getPhone(),
                $dto->getComment(),
            );
        } catch (Exception) {
            throw new ServiceUnavailableHttpException(trans('productRating.creating.failed'));
        }
    }
}
