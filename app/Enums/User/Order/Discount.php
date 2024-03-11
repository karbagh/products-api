<?php

namespace App\Enums\User\Order;

use App\Dtoes\Users\Discount\UserDiscountDto;

enum Discount: int
{
    case NO_LEVEL = 0;
    case FIRST_LEVEL = 1;
    case SECOND_LEVEL = 2;
    case THIRD_LEVEL = 3;
    case FORTH_LEVEL = 4;

    public static function level(float $amount): self {
        return match (true) {
            $amount > 500000 && $amount <= 1000000 => self::FIRST_LEVEL,
            $amount > 1000000 && $amount <= 2000000,  => self::SECOND_LEVEL,
            $amount > 2000000 && $amount < 3000000 => self::THIRD_LEVEL,
            $amount > 3000000 => self::FORTH_LEVEL,
            default => self::NO_LEVEL
        };
    }

    public function discountDetails(): UserDiscountDto
    {
        return match ($this) {
            self::FIRST_LEVEL => new UserDiscountDto(
                self::FIRST_LEVEL->value,
                2,
                false,
                false,
            ),
            self::SECOND_LEVEL => new UserDiscountDto(
                self::SECOND_LEVEL->value,
                3,
                false,
                false,
            ),
            self::THIRD_LEVEL => new UserDiscountDto(
                self::THIRD_LEVEL->value,
                4,
                true,
                false,
            ),
            self::FORTH_LEVEL => new UserDiscountDto(
                self::FORTH_LEVEL->value,
                5,
                true,
                false,
            ),
            default => new UserDiscountDto(
                0,
                0,
                false,
                false,
            ),
        };
    }
}
