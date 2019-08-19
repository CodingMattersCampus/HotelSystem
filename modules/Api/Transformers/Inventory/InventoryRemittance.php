<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Inventory;

use Illuminate\Http\Resources\Json\Resource;

final class InventoryRemittance extends Resource
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
            'id'        => $this->id,
            'sku'       => $this->sku,
            'product'   => $this->product(),
            'remitted'  => $this->remitted,
            'remaining' => $this->remaining,
        ];
    }
}
