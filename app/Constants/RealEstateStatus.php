<?php

namespace App\Constants;


class RealEstateStatus
{
    public const NOT_AVAILABLE = 'not available';
    public const PREPARING_FOR_SELLING = 'preparing for selling';
    public const RENTING = 'renting';
    public const RENTED = 'rented';
    public const SELLING = 'selling';
    public const SOLD = 'sold';
    public const BUILDING = 'building';

    public static function getAllListRealEstateStatus(): array
    {
        return [
            self::NOT_AVAILABLE,
            self::PREPARING_FOR_SELLING,
            self::SELLING,
            self::SOLD,
            self::BUILDING,
            self::RENTING,
            self::RENTED,
        ];
    }
}
