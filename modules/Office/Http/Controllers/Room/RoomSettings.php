<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Room;

use App\Models\Room\Room;
use App\Models\Room\RoomStatus;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class RoomSettings extends Controller
{
    public function __invoke(Room $room) : View
    {
        $statuses = RoomStatus::getStatuses();
        $token = Auth::guard('office')->user()->api_token;
        return view("office::room.settings", compact('room', 'statuses', 'token'));
    }
}
