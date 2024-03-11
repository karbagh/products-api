<?php

namespace App\Enums\Product\PriceRequest;

enum Status: string
{
    case PENDING = 'pending';
    case APPROVE = 'approve';
    case REJECT = 'reject';
    case COUNTER = 'counter';


    public function htmlClasses(): string
    {
        return match ($this) {
            self::PENDING => 'badge bg-info',
            self::APPROVE => 'badge bg-green',
            self::REJECT => 'badge bg-red',
            self::COUNTER => 'badge bg-yellow',
        };
    }

    public function status(): string
    {
        return $this->value;
    }

    public static function toArray(): array
    {
        return [
            'pending' => 'Pending',
            'approve ' => 'Approve',
            'reject' => 'Reject',
            'counter' => 'Counter',
        ];
    }

    public function translation(): string
    {
        return match ($this) {
            self::PENDING => trans('order.status.pending'),
            self::APPROVE => trans('order.status.approve'),
            self::REJECT => trans('order.status.reject'),
            self::COUNTER => trans('order.status.counter'),
        };
    }


    public static function translations(): array
    {
        return [
            'pending' => trans('products.priceRequest.status.pending'),
            'approve' => trans('products.priceRequest.status.approve'),
            'reject' => trans('products.priceRequest.status.reject'),
            'counter' => trans('products.priceRequest.status.counter'),
        ];
    }

    public static function color(): array
    {
        return [
            'white' => 'pending',
            'success' => 'approve',
            'danger' => 'reject',
            'warning' => 'counter',
        ];
    }
}
