<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Room;

use Illuminate\Http\Resources\Json\Resource;

final class Room extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) : array
    {
        return parent::toArray($request);
    }
}
