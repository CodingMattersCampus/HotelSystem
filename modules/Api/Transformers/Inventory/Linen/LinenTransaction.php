<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Inventory\Linen;

use Illuminate\Http\Resources\Json\Resource;

final class LinenTransaction extends Resource
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
            'created_at'    => $this->created_at->diffForHumans(),
            'description'   => $this->description,
            'user'          => $this->user,
            'in'            => $this->in,
            'out'           => $this->out,
            'room'          => $this->room,
            'inventory'     => $this->inventory(),
        ];
    }
}
