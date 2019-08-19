<?php

namespace CodingMatters\Api\Transformers\Booking;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Booking\Booking;

class AggregateCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $this->collection->transform(function (Booking $booking) {

            return [
                "net_sales"         => number_format((float) $booking->net_sales, 2),
                "taxi_referral_fee" => number_format((float) $booking->taxiReferral(), 2),
                "rate"              => number_format((float) $booking->rate(), 2),
                "orders"            => number_format((float) $booking->totalOrders(), 2),
                "penalties"         => number_format((float) $booking->totalPenalties(), 2),
                "extends"           => number_format((float) $booking->extends, 2),
                "transfers"         => number_format((float) $booking->transfers, 2)
            ];
        });

        return [
            'sub_net_sales' => $this->collection->sum('net_sales'),
            'taxi_fees' => $this->collection->sum('taxi_referral_fee'),
            'booking_rates' => $this->collection->sum('rate'),
            'orders' => $this->collection->sum("orders"),
            'penalties' => $this->collection->sum('penalties'),
            'extends' => $this->collection->sum("extends"),
            'transfers' => $this->collection->sum('transfers'),
        ];
    }
}
