<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Cash;

use Illuminate\Http\Resources\Json\Resource;

final class CashTransaction extends Resource
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
            'transaction'   => $this->transaction(),
            'created_at'    => $this->created_at->toDayDateTimeString(),
            'description'   => $this->description,
            'amount'        => $this->amount,
            'cash'          => $this->cash,
            'change'        => $this->change,
        ];
    }
}
