<?php

declare(strict_types = 1);

namespace App\Models\Cash;

final class ApprovalType
{
    public const APPROVED = 'approved';
    public const PENDING = 'pending';
    public const REJECTED = 'rejected';
    //public const GIVEN = 'given'; //Tentative for functions if given after approval

    public static function getTypes() : array
    {
        return [
            self::APPROVED => ucwords(self::APPROVED),
            self::PENDING  => ucwords(self::PENDING),
            self::REJECTED => ucwords(self::REJECTED),
        ];
    }
}
