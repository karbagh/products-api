<?php

namespace App\Http\Resources\Products\Images;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
use stdClass;


/**
 * @OA\Schema(
 *     title="Article Image Resource",
 *     description="Article Image resource",
 *     schema="ArticleImageResourceSchema",
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
class ImageResource extends JsonResource
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
            'src' => url($this?->is_default ? $this->src : Storage::url($this->src)),
            'isMain' => (bool) $this->is_main,
        ];
    }
}
