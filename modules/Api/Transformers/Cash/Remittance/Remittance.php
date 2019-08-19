<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Cash\Remittance;

use Illuminate\Http\Resources\Json\Resource;

final class Remittance extends Resource
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
            'code'          => $this->code,
            'transaction'   => $this->transaction(),
            'cashier'       => $this->cashier(),
            'start'         => $this->beginningTransaction(),
            'end'           => $this->endingTransaction(),
            'amount'        => $this->expectedAmount(),
            'remitted'      => $this->remittedAmount(),
        ];
    }
}
