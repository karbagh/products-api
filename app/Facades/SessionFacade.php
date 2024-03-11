<?php

namespace App\Facades;

use App\Services\Cart\CartListService;
use Exception;
use Illuminate\Support\Facades\Facade;

class SessionFacade extends Facade
{
    public function __construct(private CartListService $cartListService)
    {
    }

    /**
     * @throws Exception
     */
    public function clear()
    {
        $this->cartListService->clear(request()->ip());
    }
}
