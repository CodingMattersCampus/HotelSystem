<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Taxi;

use Illuminate\Http\Resources\Json\Resource;

final class TaxiBooking extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) : array
    {
        return $this->collection->sum('referral_fee');
    }
}
