<?php

namespace CodingMatters\Api\Transformers\Cash;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CashTransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
