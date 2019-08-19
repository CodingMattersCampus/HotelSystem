<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Room;

use Illuminate\Routing\Controller;
use App\Models\Room\Room;
use CodingMatters\Store\Http\Requests\Room\ChangeRoomStatusRequest;

final class ChangeRoomStatus extends Controller
{
    public function __invoke(Room $room, ChangeRoomStatusRequest $request)
    {
        $status = $request->get('status');

        $room->updateStatusTo($status);

        return response(
            ['status' => $status],
            200
        );
    }
}
