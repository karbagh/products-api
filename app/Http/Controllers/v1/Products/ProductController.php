<?php

namespace App\Http\Controllers\v1\Products;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Services\Products\ProductsService;
use App\Http\Controllers\v1\ApiController;
use App\Http\Resources\Products\ProductResource;

/**
 * @OA\Tag(
 *     name="Products",
 *     description="API Endpoints of Products"
 * )
 * */
final class ProductController extends ApiController
{
    /**
     * @OA\Get(
     *     tags={"Products"},
     *     path="/products?perPage={perPage}",
     *     summary="Get a list of Products",
     *     @OA\Parameter(
     *          description="Count of per page.",
     *          in="query",
     *          name="perPage",
     *          required=false,
     *          example="20",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResourceSchema")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     *
     * @param ProductsService $service
     * @return JsonResponse
     */
    public function list(ProductsService $service): JsonResponse
    {
        return response()->success([
            'products' => ProductsResource::collection(
                $service->getAllOfBranch()->paginate(request()->query('perPage') ?? 20)
            )->response()->getData(true),
        ], 'ProductList');
    }

    /**
     * @OA\Get(
     *     tags={"Products"},
     *     path="/products/{id}?perPage={perPage}",
     *     summary="Get a list of Products",
     *     @OA\Parameter(
     *          description="Product ID.",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="2268e296-a103-3755-b2a8-7542e0ee2a9e",
     *          @OA\Schema(
     *              type="string",
     *              format="uuid"
     *          )
     *     ),
     *     @OA\Parameter(
     *          description="Count of per page.",
     *          in="query",
     *          name="perPage",
     *          required=false,
     *          example="20",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResourceSchema")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     *
     * @param Product $product
     * @return ProductResource
     */
    public function view(Product $product): ProductResource
    {
        return ProductResource::make($product->load([
            'mainImage',
            'images',
        ]));
    }
}
