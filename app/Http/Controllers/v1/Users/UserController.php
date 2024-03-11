<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\v1\ApiController;
use App\Http\Resources\Gift\GiftResource;
use App\Http\Resources\Orders\OrderResource;
use App\Http\Resources\Users\UserResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="User",
 *     description="API Endpoints of User"
 * )
 * */
class UserController extends ApiController
{
    /**
     * @OA\Get(
     *     tags={"User"},
     *     path="/users/orders?perPage={perPage}",
     *     summary="Get the orders of User",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/UserResourceSchema")
     *     ),
     *     @OA\Parameter(
     *          description="Count of per page.",
     *          in="query",
     *          name="perPage",
     *          required=false,
     *          example="10",
     *          @OA\Schema(
     *              type="integer",
     *              format="int64"
     *          )
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     *
     * @return AnonymousResourceCollection
     */
    public function orders(): AnonymousResourceCollection
    {
        return OrderResource::collection(Auth::user()
            ->orders()
            ->whereHas('payments')
            ->orderByDesc('created_at')
            ->with(['customer', 'extraOptions',])
            ->withCount(['reverses'])
            ->paginate(request()->query('perPage') ?? 10)
        );
    }

    /**
     * @OA\Get(
     *     tags={"User"},
     *     path="/users/settings",
     *     summary="Get the settings of User",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/UserResourceSchema")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     *
     * @return UserResource
     */
    public function settings(): UserResource
    {
        return UserResource::make(Auth::user());
    }

    /**
     * @OA\Get(
     *     tags={"User"},
     *     path="/users/gifts",
     *     summary="Get the gifts of User",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/UserResourceSchema")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     *
     * @return AnonymousResourceCollection
     */
    public function gifts(): AnonymousResourceCollection
    {
        return GiftResource::collection(Auth::user()->gifts);
    }

    /**
     * @OA\Delete (
     *     tags={"User"},
     *     path="/users",
     *     summary="Delete of User",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *           @OA\Property(
     *              property="errors",
     *              type="boolean",
     *              example="false"
     *           ),
     *           @OA\Property(
     *              property="message",
     *              type="string",
     *              example="Successfully deleted."
     *           ),
     *       )
     *    ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     *
     * @return JsonResponse
     */
    public function delete(): JsonResponse
    {
        Auth::user()->delete();

        return response()->successMessage(trans('user.delete.success'));
    }
}
