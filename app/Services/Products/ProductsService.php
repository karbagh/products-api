<?php

namespace App\Services\Products;

use App\Collections\OneS\Product\OneSProductCollection;
use App\Dtoes\Product\PriceRequest\CreatePriceRequestRequestDto;
use App\Enums\Product\Trend;
use App\Models\Category;
use App\Models\PriceRequest;
use App\Models\User;
use App\Repositories\Products\ProductRepository;
use App\Repositories\Products\Unit\UnitRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Symfony\Component\HttpKernel\Exception\ConflictHttpException;

class ProductsService
{

    public function __construct(
        private readonly ProductRepository $repository,
    ) {}

    public function getAllOfBranch(): Builder
    {
        return $this->repository->getProducts()->with(['mainImage']);
    }
}
