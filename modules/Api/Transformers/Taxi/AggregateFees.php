<?php

namespace CodingMatters\Api\Transformers\Taxi;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AggregateFees extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'Total Fees' => $this->collection->sum('referral_fee'),
        ];
    }
}
