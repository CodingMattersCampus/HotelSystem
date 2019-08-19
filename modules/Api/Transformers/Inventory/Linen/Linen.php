<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Inventory\Linen;

use Illuminate\Http\Resources\Json\Resource;

final class Linen extends Resource
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
            'name'          => $this->name,
            'slug'          => $this->slug,
            'rooms'         => $this->rooms,
            'laundry'       => $this->laundry,
            'store'         => $this->store,
            'stocks'        => $this->availableStocks(),
            'updated_at'    => $this->updated_at->diffForHumans(),
        ];
    }
}
