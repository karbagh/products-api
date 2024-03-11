<?php

namespace App\Http\Controllers\v1\Products\PriceRequests;

use App\Dtoes\Product\PriceRequest\CreatePriceRequestRequestDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\PriceRequest\CreatePriceRequestRequest;
use App\Http\Resources\Products\PriceRequestResource;
use App\Models\PriceRequest;
use App\Services\Products\ProductsService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class PriceRequestController extends Controller
{

    public function index(): AnonymousResourceCollection
    {
        return PriceRequestResource::collection(Auth::user()
            ->priceRequests()
            ->with(
                [
                    'product' => fn($q) => $q->with('mainImage'),
                    'approvedBy',
                    'declinedBy',
                ]
            )
            ->orderByDesc('created_at')
            ->paginate(request()->query('perPage') ?? 15));
    }

    public function view(PriceRequest $request): PriceRequestResource
    {
        return PriceRequestResource::make($request->load([
            'product' => fn($q) => $q->with('mainImage'),
            'user',
            'approvedBy',
            'declinedBy',
        ]));
    }

    public function create(CreatePriceRequestRequest $request, ProductsService $service): AnonymousResourceCollection
    {
        return PriceRequestResource::collection($service->createPriceRequest(new CreatePriceRequestRequestDto(
            Auth::user(),
            $request->items,
        ))->load([
            'product' => fn($q) => $q->with('mainImage'),
            'user',
            'approvedBy',
            'declinedBy',
        ]));
    }

    public function approve(PriceRequest $request, ProductsService $service): PriceRequestResource
    {
        return PriceRequestResource::make($service->approvePrice(Auth::user(), $request)->load([
            'product' => fn($q) => $q->with('mainImage'),
            'user',
            'approvedBy',
            'declinedBy',
        ]));
    }

    public function decline(PriceRequest $request, ProductsService $service): PriceRequestResource
    {
        return PriceRequestResource::make($service->declinePrice(Auth::user(), $request)->load([
            'product' => fn($q) => $q->with('mainImage'),
            'user',
            'declinedBy',
            'declinedBy',
        ]));
    }
}
