<?php

namespace App\Http\Controllers\v1\Size;

use App\Http\Controllers\v1\ApiController;
use App\Http\Resources\Sizes\SizeResource;
use App\Models\Product;
use App\Models\Size;
use App\Services\Size\SizeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

/**
 * @OA\Tag(
 *     name="Sizes",
 *     description="API Endpoints of Sizes"
 * )
 * */
final class SizeController extends ApiController
{
    /**
     * @OA\Get(
     *     tags={"Sizes"},
     *     path="/sizes",
     *     summary="Get a list of Sizes",
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/SizeResourceSchema")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     *
     * @param SizeService $service
     * @return JsonResponse
     */
    public function list(SizeService $service): JsonResponse
    {
        return response()->success([
            SizeResource::collection(
                $service->list()
            )->response()->getData(true),
        ], 'Size List');
    }

    /**
     * @OA\Get(
     *     tags={"Sizes"},
     *     path="/sizes/{id}",
     *     summary="Get a single Size",
     *     @OA\Parameter(
     *          description="Size ID.",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="string",
     *              format="numeric"
     *          )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(ref="#/components/schemas/SizeResourceSchema")
     *     ),
     *     @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     * )
     *
     * @param Size $size
     * @return SizeResource
     */
    public function view(Size $size): SizeResource
    {
        return SizeResource::make($size->load('products'));
    }

    /**
     * @OA\Delete(
     *     tags={"Sizes"},
     *     path="/sizes/{id}",
     *     summary="Delete Size",
     *     @OA\Parameter(
     *          description="Size ID.",
     *          in="path",
     *          name="id",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *              type="string",
     *              format="numeric"
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
     * @param Size $size
     * @return JsonResponse
     */
    public function delete(Size $size): JsonResponse
    {
        $size->delete();

        return response()->successMessage(
            trans('sizes.actions.delete.success'),
            ResponseStatus::HTTP_NO_CONTENT
        );
    }
}
