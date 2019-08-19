<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Booking;

use Illuminate\Http\Resources\Json\Resource;

final class Transfer extends Resource
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
            'id'            => $this->id,
            'created_at'    => $this->created_at->toDayDateTimeString(),
            'transaction'   => $this->transaction(),
            'reason'        => $this->reason,
            'from'          => $this->from,
            'to'            => $this->to,
            'employee'      => $this->employee(),
            'payment'       => $this->payment
        ];
    }
}
