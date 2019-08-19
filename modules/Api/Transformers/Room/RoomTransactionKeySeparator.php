<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Room;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class RoomTransactionKeySeparator extends ResourceCollection
{
    public function toArray($request) : array
    {
        $this->collection->transform(function ($set, $key) {
            return new RoomTransaction($set);
        }); //Some missing {x,y} based on missing days //Sort this by x

        return parent::toArray($request);
    }
}
