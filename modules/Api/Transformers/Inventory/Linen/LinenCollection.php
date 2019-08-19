<?php

namespace CodingMatters\Api\Transformers\Inventory\Linen;

use Illuminate\Http\Resources\Json\ResourceCollection;

class LinenCollection extends ResourceCollection
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
