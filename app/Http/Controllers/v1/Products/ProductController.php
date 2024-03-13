<?php

namespace App\Http\Controllers\v1\Products;

use App\Dtoes\Product\CreateProductRequestDto;
use App\Dtoes\Product\UpdateProductRequestDto;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\v1\ApiController;
use App\Services\Products\ProductsService;
use App\Http\Resources\Products\ProductResource;
use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\UpdateProductRequest;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

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
            'products' => ProductResource::collection(
                $service->getAllOfBranch()->paginate(request()->query('perPage') ?? 20)
            )->response()->getData(true),
        ], 'ProductList');
    }

    /**
     * @OA\Get(
     *     tags={"Products"},
     *     path="/products/{id}",
     *     summary="Get a single Product",
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
            'sizes',
            'mainImage',
            'images',
        ]));
    }

    /**
     * @OA\Post(
     *     tags={"Products"},
     *     path="/products",
     *     summary="CraetePorudct",
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/CreateProductRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResourceSchema"),
     *       ),
     *    ),
     *    @OA\Response(
     *          response=422,
     *          description="Validation Errors",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="Validation message."
     *              ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/CreateProductRequestMessagesSchema"
     *              ),
     *          ),
     *      ),
     * )
     *
     * @param CreateProductRequest $request
     * @param ProductsService $service
     * @return ProductResource
     */
    public function create(CreateProductRequest $request, ProductsService $service): ProductResource
    {
        return ProductResource::make(
            $service->create(
                new CreateProductRequestDto(
                    $request->name['hy'],
                    $request->name['ru'],
                    $request->name['en'],
                    $request->description['hy'],
                    $request->description['ru'],
                    $request->description['en'],
                    $request->price,
                )
            )
        );
    }

    /**
     * @OA\Put (
     *     tags={"Products"},
     *     path="/products/{id}",
     *     summary="Update Porudct",
     *     @OA\Parameter(
     *        description="Product ID.",
     *        in="path",
     *        name="id",
     *        required=true,
     *        example="2268e296-a103-3755-b2a8-7542e0ee2a9e",
     *        @OA\Schema(
     *            type="string",
     *            format="uuid"
     *        )
     *     ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateProductRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResourceSchema"),
     *       ),
     *    ),
     *    @OA\Response(
     *         response=423,
     *         description="Validation Errors",
     *         @OA\JsonContent(
     *            @OA\Property(
     *                property="message",
     *                type="string",
     *                example="Validation message."
     *             ),
     *            @OA\Property(
     *                property="errors",
     *                type="object",
     *                ref="#/components/schemas/UpdateProductRequestMessagesSchema"
     *            ),
     *         ),
     *     ),
     * )
     *
     * @param Product $product
     * @param UpdateProductRequest $request
     * @param ProductsService $service
     * @return ProductResource
     */
    public function update(Product $product, UpdateProductRequest $request, ProductsService $service): ProductResource
    {
        return ProductResource::make(
            $service->update(
                $product,
                new UpdateProductRequestDto(
                    $request->name['hy'],
                    $request->name['ru'],
                    $request->name['en'],
                    $request->description['hy'],
                    $request->description['ru'],
                    $request->description['en'],
                    $request->price,
                )
            )
        );
    }

    /**
     * @OA\Delete(
     *     tags={"Products"},
     *     path="/products/{id}",
     *     summary="Delete Product",
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
     *     @OA\Response(
     *         response=204,
     *         description="No Content",
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function delete(Product $product): JsonResponse
    {
        $product->delete();

        return response()->successMessage(
            trans('products.actions.delete.success'),
            ResponseStatus::HTTP_NO_CONTENT
        );
    }
}
