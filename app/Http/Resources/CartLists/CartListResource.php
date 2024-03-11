<?php

namespace App\Http\Resources\CartLists;

use Illuminate\Http\Request;
use App\Http\Resources\Products\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;
use NumberFormatter;

/**
 * @OA\Schema(
 *     title="Cart List Resource",
 *     description="Cart List resource",
 *     schema="CartListResourceSchema",
 * 	   @OA\Property(
 *          property="count",
 *          type="number",
 *          example="10.0"
 *     ),
 * 	   @OA\Property(
 *          property="total",
 *          type="number",
 *          example="2706426.00"
 *     ),
 * 	    @OA\Property(
 *          property="characteristics",
 *          type="array",
 *           nullable="true",
 *          @OA\Items(
 *              ref="#/components/schemas/ProductResourceSchema",
 *          ),
 *      ),
 * )
 * */
class CartListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $fmt = numfmt_create('hy_AM', NumberFormatter::CURRENCY);

        return [
            'count' => (float) $this->count,
            'total' => numfmt_format_currency($fmt, round($this->total, 3), "AMD"),
            'product' => ProductResource::make($this->whenLoaded('product')),
        ];
    }
}
