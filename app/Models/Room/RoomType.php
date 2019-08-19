<?php

declare(strict_types = 1);

namespace App\Models\Room;

final class RoomType
{
    public const GARAGE = 'garage';
    public const NON_GARAGE = 'non-garage';

    public static function getTypes() : array
    {
        return [
            self::GARAGE => ucwords(self::GARAGE),
            self::NON_GARAGE => ucwords(self::NON_GARAGE),
        ];
    }
}
