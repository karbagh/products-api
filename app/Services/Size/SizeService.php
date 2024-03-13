<?php

namespace App\Services\Size;

use App\Models\Size;
use App\Repositories\Size\SizeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;

class SizeService
{
    public function __construct(
        private readonly SizeRepository $repository
    )
    {
    }

    public function list(): LengthAwarePaginator
    {
        return $this->repository->query()->paginate(10);
    }
}
