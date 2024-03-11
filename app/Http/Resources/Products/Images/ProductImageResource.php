<?php

namespace App\Http\Resources\Products\Images;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


/**
 * @OA\Schema(
 *     title="Product Image Resource",
 *     description="Product Image resource",
 *     schema="ProductImageResourceSchema",
 * 	   @OA\Property(
 *          property="src",
 *          type="string",
 *          example="https://via.placeholder.com/640x480.png/0033dd?text=corrupti"
 *     ),
 * 	   @OA\Property(
 *          property="isMain",
 *          type="boolean",
 *          example="true"
 *     )
 * )
 **/
class ProductImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'src' => $this->src,
            'isMain' => $this->is_main,
        ];
    }
}
