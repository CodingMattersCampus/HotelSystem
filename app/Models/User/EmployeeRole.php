<?php

declare(strict_types = 1);

namespace App\Models\User;

final class EmployeeRole
{
    public const MANAGER = "manager";
    public const SUPERVISOR = "supervisor";
    public const CASHIER = "cashier";
    public const CLEANER   = "cleaner";
    public const GUARD = "guard";
    public const DRIVER = "driver";

    public static function getRoles() : array
    {
        return [
            self::MANAGER => ucwords(self::MANAGER),
            self::SUPERVISOR => ucwords(self::SUPERVISOR),
            self::CASHIER => ucwords(self::CASHIER),
            self::CLEANER => ucwords(self::CLEANER),
            self::GUARD => ucwords(self::GUARD),
            self::DRIVER => ucwords(self::DRIVER),
        ];
    }
}
