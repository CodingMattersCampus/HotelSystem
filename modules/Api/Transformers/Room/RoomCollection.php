<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Room;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class RoomCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) : array
    {
        return parent::toArray($request);
    }
}
