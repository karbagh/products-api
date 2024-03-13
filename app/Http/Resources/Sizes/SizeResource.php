<?php

namespace App\Http\Resources\Sizes;

use App\Http\Resources\Products\ProductResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SizeResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     title="Size Resource",
     *     description="Size resource",
     *     schema="SizeResourceSchema",
     * 	   @OA\Property(
     *          property="id",
     *          type="string",
     *          example="1"
     *     ),
     * 	   @OA\Property(
     *          property="title",
     *          type="string",
     *          example="Title"
     *     ),
     * 	    @OA\Property(
     *          property="products",
     *          type="object",
     *          ref="#/components/schemas/ProductResourceSchema",
     *      ),
     * )
     *
     * @param Request $request
     * @return array|JsonSerializable|Arrayable
     */
    public function toArray($request): array|JsonSerializable|Arrayable
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'products' => ProductResource::collection($this->whenLoaded('products')),
        ];
    }
}
