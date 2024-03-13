<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\v1\ApiController;
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
final class UserController extends ApiController
{
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
