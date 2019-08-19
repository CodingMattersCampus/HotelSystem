<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Booking;

use Illuminate\Http\Resources\Json\Resource;

final class Booking extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'id' => $this->id,
            'code' => $this->code(),
            'booking_number' => $this->transaction(),
            'room' => $this->room(),
            'checkin' => $this->checkInDateTime(),
            'checkout' => $this->checkOutDateTime(),
            'taxi' => number_format((float) $this->taxiReferral(), 2),
            'rate' => number_format((float) $this->rate, 2), //original rate
            'total_orders' => number_format((float) $this->totalOrders(), 2),
            'total_penalties' => number_format((float) $this->totalPenalties(), 2),
            'net_sales' => number_format($this->net_sales, 2),
            'checkin_by' => $this->checkedInBy(),
            'checkout_by' => $this->checkedOutBy(),
            'transfers' => number_format((float) $this->transfers, 2),
            'extends'   => number_format((float) $this->extends, 2)
        ];
    }
}
