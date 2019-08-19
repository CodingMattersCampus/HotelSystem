<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Cash\Remittance;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class ChartRemittanceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function ($collection) {
            //group by cashier name
            return $collection->groupBy(function ($rem) {
                return $rem->cashier();
            })
            //transform groupdata to aggregate object
            ->transform(function ($subcollection) {
                return new AggregateByNameCollection($subcollection);
            });
        });

        return [
            'data' => $this->collection //Need so that keys are retained.
        ];
    }
}
