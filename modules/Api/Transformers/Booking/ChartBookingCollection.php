<?php

namespace CodingMatters\Api\Transformers\Booking;

use Illuminate\Http\Resources\Json\ResourceCollection;
use CodingMatters\Api\Transformers\Booking\Booking as BookingResource;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use App\Helpers\SystemTime;

class ChartBookingCollection extends ResourceCollection
{
    use SystemTime;

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $this->collection->transform(function ($d) {
            return new AggregateCollection($d);
        });

        return [
            'data' => $this->collection,
            'meta' => [],
        ];
    }
}
