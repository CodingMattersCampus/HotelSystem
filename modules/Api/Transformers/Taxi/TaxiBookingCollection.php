<?php

namespace CodingMatters\Api\Transformers\Taxi;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TaxiBookingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function ($taxicollection) {
                return $taxicollection->groupBy(function ($tb) {
                        return strtoupper($tb->taxi);
                })
                    ->transform(function ($taxicollection) {
                        return new AggregateFees($taxicollection);
                    });
        });

        return parent::toArray($request);
    }
}
