<?php

namespace App\Http\Resources\Users;

use App\Http\Resources\Orders\OrderResource;
use App\Http\Resources\Partner\PartnerResource;
use App\Http\Resources\Products\ProductResource;
use App\Http\Resources\Roles\RoleResource;
use App\Http\Resources\Subscription\SubscriptionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @OA\Schema(
     *     title="User Resource",
     *     description="User resource",
     *     schema="UserResourceSchema",
     * 	   @OA\Property(
     *          property="fullName",
     *          type="string",
     *          example="Jsohn Smith"
     *     ),
     * 	   @OA\Property(
     *          property="firstName",
     *          type="string",
     *          example="John"
     *     ),
     * 	   @OA\Property(
     *          property="lastName",
     *          type="string",
     *          example="Smith"
     *     ),
     * 	   @OA\Property(
     *          property="email",
     *          type="string",
     *          example="email@email.com"
     *     ),
     * 	   @OA\Property(
     *          property="phone",
     *          type="string",
     *          example="+37499000000"
     *     ),
     *     @OA\Property(
     *          property="isPartner",
     *          type="boolean",
     *          example="true"
     *     ),
     * )
     * */
    public function toArray($request)
    {
        return [
            'fullName' => $this->fullName,
            'firstName' => $this->first_name,
            'lastName' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'isPartner' => $this->isPartner,
            'discountDetails' => $this->discountDetails?->toArray(),
            'role' => RoleResource::make($this->whenLoaded('role')),
            'partner' => PartnerResource::make($this->whenLoaded('partner')),
            'favorites' => ProductResource::collection($this->whenLoaded('favorites')),
            'subscriptions' => SubscriptionResource::make($this->whenLoaded('subscriptions')),
            'orders' => OrderResource::collection($this->whenLoaded('orders')),
            'ordersWithDetails' => OrderResource::collection($this->whenLoaded('ordersWithDetails')),
        ];
    }
}
