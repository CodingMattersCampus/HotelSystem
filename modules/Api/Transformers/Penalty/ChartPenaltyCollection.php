<?php

namespace CodingMatters\Api\Transformers\Penalty;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ChartPenaltyCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function ($bookingpenalty) {
                return $bookingpenalty->groupBy(function ($bp) {
                        return $bp->penalty();
                })
                ->transform(function ($bookingpenalty) {
                    return new AggregateFees($bookingpenalty);
                });
        });
        return parent::toArray($request);
    }
}
