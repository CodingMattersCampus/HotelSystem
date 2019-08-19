<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Cash\CashAdvance;

use Illuminate\Http\Resources\Json\Resource;

final class CashAdvance extends Resource
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
            "id"            => $this->id,
            "transaction"   => $this->transaction(),
            "employee"      => $this->employee(),
            "created_at"    => $this->created_at->toDayDateTimeString(),
            "amount"        => (float) $this->amount,
            "approval"      => $this->approval,
            'given'         => $this->given,
            "cashier"       => $this->cashier(),
            "updated_at"    => $this->updated_at->toDayDateTimeString(),
        ];
    }
}
