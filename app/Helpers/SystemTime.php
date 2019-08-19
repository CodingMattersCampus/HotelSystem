<?php

declare(strict_types=1);

namespace App\Helpers;

use Carbon\Carbon;

trait SystemTime
{
    public function getCurrentTime() : Carbon
    {
        return Carbon::now('Asia/Manila');
    }
}
