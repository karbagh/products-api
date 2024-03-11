<?php

namespace App\Enums\Product\Feedback;

enum Status: string
{
    case PENDING = 'pending';
    case SUCCESS = 'success';

    public function translation(): string
    {
        return match ($this) {
            self::PENDING => trans('order.status.pending'),
            self::SUCCESS => trans('order.status.success'),
        };
    }

    public static function translations(): array
    {
        return [
            'pending' => trans('order.status.pending'),
            'success' => trans('order.status.success'),
        ];
    }

    public static function color(): array
    {
        return [
            'primary' => 'pending',
            'success' => 'success',
        ];
    }
}
