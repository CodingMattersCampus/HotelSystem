<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Inventory\Product;

use Illuminate\Http\Resources\Json\Resource;

final class OrderableProduct extends Resource
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
            'name'          => $this->name,
            'sku'           => $this->sku,
            'brand'         => $this->brandName(),
            'profit_margin' => $this->profit_margin,
            'stocks'        => $this->stocks,
            'is_active'     => $this->isActive() ? 'Yes' : 'No',
        ];
    }
}
