<?php

namespace App\Http\Controllers\v1\CartLists;

use App\Dtoes\Cart\AddToCartRequestDto;
use App\Dtoes\Cart\ChangeCountInCartCartRequestDto;
use App\Dtoes\Cart\ReduceFromCartRequestDto;
use App\Http\Controllers\v1\ApiController;
use App\Http\Requests\Cart\AddToCartRequest;
use App\Http\Requests\Cart\ChangeCountInCartRequest;
use App\Http\Requests\Cart\ReduceFromCartRequest;
use App\Http\Resources\CartLists\CartResource;
use App\Models\Product;
use App\Services\Cart\CartListService;
use Exception;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * @OA\Tag(
 *    name="Cart",
 *    description="API Endpoints of Cart"
 * )
 * */
final class CartController extends ApiController
{
    /**
     * @OA\Get(
     *     tags={"Cart"},
     *     path="/carts",
     *     summary="Get a list of list products in cart",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *           @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                  ref="#/components/schemas/CartResourceSchema"
     *              )
     *           )
     *       )
     *     ),
     *    @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *    )
     *
     * @param CartListService $service
     * @return CartResource
     * @throws Exception
     */
    public function index(CartListService $service): CartResource
    {
        return CartResource::make($service->getByBranchId(request()->server('HTTP_CF_CONNECTING_IP') ?? request()->ip()));
    }

    /**
     * @OA\Post(
     *     tags={"Cart"},
     *     path="/carts/add",
     *     summary="Add product to the cart.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AddToCartRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *           @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                  ref="#/components/schemas/CartResourceSchema"
     *              )
     *           )
     *       )
     *     ),
     *    @OA\Response(
     *          response=422,
     *          description="Validation Errors",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="The selected id is invalid."
     *              ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/AddToCartRequestMessagesSchema"
     *              )
     *          )
     *    ),
     *    @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *    )
     *
     * @param AddToCartRequest $request
     * @param CartListService $service
     * @return JsonResponse
     */
    public function add(AddToCartRequest $request, CartListService $service): JsonResponse
    {
        $service->addToCart(new AddToCartRequestDto(
            request()->server('HTTP_CF_CONNECTING_IP') ?? request()->ip(),
            $request->id,
            $request->count,
            auth()->user(),
        ));

        return response()->successMessage(trans('cart.product.add.success'));
    }

    /**
     * @OA\Post(
     *     tags={"Cart"},
     *     path="/carts/reduce",
     *     summary="Reduce product from the cart.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ReduceFromCartRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *           @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                  ref="#/components/schemas/CartResourceSchema"
     *              )
     *           )
     *       )
     *     ),
     *    @OA\Response(
     *          response=422,
     *          description="Validation Errors",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="The selected id is invalid."
     *              ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/ReduceFromCartRequestMessagesSchema"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *    )
     *
     * @param ReduceFromCartRequest $request
     * @param CartListService $service
     * @return JsonResponse
     */
    public function reduce(ReduceFromCartRequest $request, CartListService $service): JsonResponse
    {
        $service->reduceFromCart(new ReduceFromCartRequestDto(
            request()->server('HTTP_CF_CONNECTING_IP') ?? request()->ip(),
            $request->id,
            $request->count,
            auth()->user(),
        ));

        return response()->successMessage(trans('cart.product.reduce.success'));
    }

    /**
     * @OA\Post(
     *     tags={"Cart"},
     *     path="/carts/change",
     *     summary="Change product count / add to cart.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/ChangeCountInCartRequestSchema")
     *      ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *           @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                  ref="#/components/schemas/CartResourceSchema"
     *              )
     *           )
     *       )
     *     ),
     *    @OA\Response(
     *          response=422,
     *          description="Validation Errors",
     *          @OA\JsonContent(
     *             @OA\Property(
     *                 property="message",
     *                 type="string",
     *                 example="The selected id is invalid."
     *              ),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/ChangeCountInCartRequestMessagesSchema"
     *              )
     *          )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthenticated",
     *     ),
     *    )
     *
     * @param ChangeCountInCartRequest $request
     * @param CartListService $service
     * @return JsonResponse
     */
    public function change(ChangeCountInCartRequest $request, CartListService $service): JsonResponse
    {
        $service->changeCountInCart(new ChangeCountInCartCartRequestDto(
            request()->server('HTTP_CF_CONNECTING_IP') ?? request()->ip(),
            $request->id,
            $request->count,
            auth()->user(),
        ));

        return response()->successMessage(trans('cart.product.change.success'));
    }

    /**
     * @OA\Delete(
     *     tags={"Cart"},
     *     path="/carts",
     *     summary="Clear products from the cart.",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *           @OA\Property(
     *              property="erros",
     *              type="boolean",
     *              example="false"
     *           ),
     *           @OA\Property(
     *              property="message",
     *              type="boolean",
     *              example="Cart cleared successfully"
     *           ),
     *       )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *       ),
     *     )
     *
     * @param CartListService $service
     * @return JsonResponse
     * @throws Exception
     */
    public function clear(CartListService $service): JsonResponse
    {
        return response()->successMessage($service->clear(request()->server('HTTP_CF_CONNECTING_IP') ?? request()->ip()));
    }

    /**
     * @OA\Delete(
     *     tags={"Cart"},
     *     path="/carts/{id}",
     *     summary="Remove product from the cart.",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/AddToCartRequestSchema")
     *      ),
     *      @OA\Parameter(
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
     *         @OA\JsonContent(
     *           @OA\Property(
     *              property="data",
     *              type="array",
     *              @OA\Items(
     *                  ref="#/components/schemas/CartResourceSchema"
     *              )
     *           )
     *       )
     *     ),
     *    @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *    )
     *
     * @param Product $product
     * @param CartListService $service
     * @return JsonResponse
     */
    public function remove(Product $product, CartListService $service): JsonResponse
    {
        $service->removeFromCart($product, request()->server('HTTP_CF_CONNECTING_IP') ?? request()->ip(),  auth()->user());

        return response()->successMessage(trans('cart.product.remove.success'));
    }
}
