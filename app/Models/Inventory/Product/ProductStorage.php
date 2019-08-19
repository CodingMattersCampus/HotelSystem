<?php

declare(strict_types = 1);

namespace App\Models\Inventory\Product;

final class ProductStorage
{
    public const WAREHOUSE  = 'warehouse';
    public const STORE      = 'store';
    public const PARKING    = 'parking';

    public static function getStorages() : array
    {
        return [
            self::WAREHOUSE => ucwords(self::WAREHOUSE),
            self::STORE     => ucwords(self::STORE),
            self::PARKING   => ucwords(self::PARKING),
        ];
    }
}
