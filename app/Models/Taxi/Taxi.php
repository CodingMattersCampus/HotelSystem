<?php

declare(strict_types = 1);

namespace App\Models\Taxi;

use Illuminate\Database\Eloquent\Model;

final class Taxi extends Model
{
    protected $guarded = [];

    public const REFERRAL_FEE = 25.00;

    public function getRouteKeyName()
    {
        return 'plate';
    }
}
