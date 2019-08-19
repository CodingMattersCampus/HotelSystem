<?php

declare(strict_types = 1);

namespace App\Models\Penalty;

use Illuminate\Database\Eloquent\Model;

final class Penalty extends Model
{
    protected $guarded = [];

    public static function getNameByCode(string $code) : string
    {
        return optional(self::whereCode($code)->first())->name;
    }
}
