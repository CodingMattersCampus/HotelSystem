<?php

namespace CodingMatters\Api\Transformers\Penalty;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AggregateFees extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'Total Fees' => $this->collection->sum('rate'),
        ];
    }
}
