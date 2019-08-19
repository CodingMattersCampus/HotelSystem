<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Cash\Remittance;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class RemittanceCollection extends ResourceCollection
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
