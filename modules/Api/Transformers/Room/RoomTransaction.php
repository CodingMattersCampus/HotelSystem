<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Room;

use Illuminate\Http\Resources\Json\Resource;
use App\Models\Room\RoomStatus;
use Carbon\Carbon;

final class RoomTransaction extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request) : array
    {
        return [
            'x' => Carbon::parse($this->created_at)->day,
            'y' => $this->getRange(strtolower($this->status))
        ];
    }

    private function getRange(string $str) : int
    {
        $arr = [
            'available' => 1,
            'occupied' => 2,
            'maintenance' => 3,
            'cleaning' => 4
        ];

        return $arr[$str];
    }
}
