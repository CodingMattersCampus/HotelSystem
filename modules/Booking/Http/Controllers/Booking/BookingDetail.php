<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Booking;

use App\Models\Room\Room;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

final class BookingDetail extends Controller
{
    public function __invoke(Room $room) : View
    {
        return view("booking::booking.detail", compact('room'));
    }
}
