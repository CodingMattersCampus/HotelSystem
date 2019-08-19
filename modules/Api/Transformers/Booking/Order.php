<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Booking;

use Illuminate\Http\Resources\Json\Resource;

final class Order extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'created_at'    => $this->created_at->toDayDateTimeString(),
            'transaction'   => $this->transaction(),
            'product'       => $this->product(),
            'price'         => $this->price,
            'quantity'      => $this->quantity,
            'total'         => $this->price * $this->quantity,
            'cashier'       => $this->cashier(),
        ];
    }
}
