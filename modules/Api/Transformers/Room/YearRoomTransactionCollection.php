<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Room;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Carbon\Carbon;

final class YearRoomTransactionCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) : array
    {
        $this->collection->transform(function ($collection, $key) {
            return [
                "name" => $key,
                "data" => new RoomTransactionKeySeparator($collection)
            ];
        });

        return [
            'series' => $this->collection->sortKeys(),
        ];
    }
}
