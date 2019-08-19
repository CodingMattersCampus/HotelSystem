<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Booking;

use App\Models\Room\Room;
use App\Models\Room\RoomStatus;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

final class Dashboard extends Controller
{
    public function __invoke() : View
    {
        $occupied = Room::with('rates')->where('status', 'occupied')->orderBy('updated_at', 'asc')->get();
        $available = Room::with('rates')->where('status', 'available')->orderBy('id', 'asc')->get();
        $cleaning = Room::whereStatus(RoomStatus::CLEANING)->orderBy('updated_at', 'desc')->get();
        $maintenance = Room::whereStatus(RoomStatus::MAINTENANCE)->orderBy('updated_at', 'asc')->get();

        return view('booking::booking.dashboard', compact('occupied', 'available', 'cleaning', 'maintenance'));
    }
}
