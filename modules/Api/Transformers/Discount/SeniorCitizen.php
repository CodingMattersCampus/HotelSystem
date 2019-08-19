<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Discount;

use Illuminate\Http\Resources\Json\Resource;

final class SeniorCitizen extends Resource
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
            'id'             => $this->id,
            'transaction'    => $this->transaction(),
            'full_name'      => $this->full_name(),
            'sc_id'          => $this->sc_id,
        ];
    }
}
