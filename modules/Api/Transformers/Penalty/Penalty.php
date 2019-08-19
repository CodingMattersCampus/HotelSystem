<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Penalty;

use Illuminate\Http\Resources\Json\Resource;

final class Penalty extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
