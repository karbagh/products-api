<?php

namespace App\Http\Resources\CartLists;

use App\Http\Resources\Products\ProductsCollectionResource;
use Illuminate\Http\Resources\Json\JsonResource;
use NumberFormatter;

/**
 * @OA\Schema(
 *     title="Cart Resource",
 *     description="Cart resource",
 *     schema="CartResourceSchema",
 * 	   @OA\Property(
 *          property="subtotal",
 *          type="number",
 *          example="300000"
 *     ),
 * 	   @OA\Property(
 *          property="discount",
 *          type="number",
 *          example="12600"
 *     ),
 * 	   @OA\Property(
 *          property="total",
 *          type="number",
 *          example="274000"
 *     ),
 * 	   @OA\Property(
 *          property="count",
 *          type="number",
 *          example=10
 *     ),
 * 	    @OA\Property(
 *          property="characteristics",
 *          type="array",
 *           nullable="true",
 *          @OA\Items(
 *              ref="#/components/schemas/CartListResourceSchema",
 *          ),
 *      ),
 * )
 * */
class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        $fmt = numfmt_create('hy_AM', NumberFormatter::CURRENCY);

        return [
            'subtotal' => numfmt_format_currency($fmt, round($this->subtotal, 3), "AMD"),
            'discount' => numfmt_format_currency($fmt, round($this->discount, 3), "AMD"),
            'total' => numfmt_format_currency($fmt, round($this->total, 3), "AMD"),
            'count' => $this->whenCounted('products'),
            'list' => CartListResource::collection($this->whenLoaded('products')),
        ];
    }
}
