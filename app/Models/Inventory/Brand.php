<?php

declare(strict_types = 1);

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

final class Brand extends Model
{
    protected $guarded = [];

    public static function getIdByName(string $name)
    {
        return self::whereName($name)->first()->id ?? 0;
    }
}
