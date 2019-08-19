<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Inventory\Product;

use Illuminate\Http\Resources\Json\Resource;

final class Product extends Resource
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
            'max_threshold' => $this->max_threshold,
            'min_threshold' => $this->min_threshold,
            'profit_margin' => $this->profit_margin,
            'stocks'        => $this->stocks,
            'price'         => $this->price,
            'cost'          => $this->cost,
            'stored'        => $this->storedAt(),
            'updated_at'    => $this->updated_at->diffForHumans(),
            'is_active'     => $this->isActive() ? 'Yes' : 'No',
        ];
    }
}
