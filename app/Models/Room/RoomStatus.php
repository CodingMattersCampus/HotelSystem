<?php

declare(strict_types = 1);

namespace App\Models\Room;

final class RoomStatus
{
    public const AVAILABLE      = 'available';
    public const OCCUPIED       = 'occupied';
    public const MAINTENANCE    = 'maintenance';
    public const CLEANING       = 'cleaning';

    public static function getStatuses() : array
    {
        return [
            self::AVAILABLE => ucwords(self::AVAILABLE),
            self::OCCUPIED => ucwords(self::OCCUPIED),
            self::MAINTENANCE => ucwords(self::MAINTENANCE),
            self::CLEANING => ucwords(self::CLEANING),
        ];
    }
}
