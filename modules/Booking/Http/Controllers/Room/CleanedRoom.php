<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Room;

use App\Models\Room\Room;
use App\Models\Room\RoomStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

final class CleanedRoom extends Controller
{
    public function __invoke(Room $room) : RedirectResponse
    {
        $room->toLaundryLinens();

        $room->updateStatusTo(RoomStatus::AVAILABLE);

        return redirect()->route('booking.dashboard');
    }
}
