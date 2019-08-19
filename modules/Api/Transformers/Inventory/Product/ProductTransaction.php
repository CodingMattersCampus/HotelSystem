<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Inventory\Product;

use Illuminate\Http\Resources\Json\Resource;

final class ProductTransaction extends Resource
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
            'date'          => $this->created_at->diffForHumans(),
            'user'          => $this->user(),
            'description'   => $this->description,
            'invoice'       => $this->invoice,
            'cost'          => $this->cost,
            'price'         => $this->price,
            'in'            => $this->in,
            'out'           => $this->out,
            'balance'       => $this->remaining,
        ];
    }
}
