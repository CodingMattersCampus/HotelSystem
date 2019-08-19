<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Room;

use App\Models\Booking\Booking;
use App\Models\Booking\ExtendHistory;
use App\Models\Room\Room;
use CodingMatters\Booking\Http\Requests\ExtendBookingRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

final class ExtendBooking extends Controller
{
    public function __invoke(Room $room, ExtendBookingRequest $request) : RedirectResponse
    {
        $employee = Auth::guard('booking')->user();

        $booking = Booking::where(['room' => $room->code, 'has_checked_out' => false])->first();

        $employee->getDrawer()->cashTransaction(
            $booking,
            "Extend Checkout Booking",
            (float) $request->post('total_amount'),
            (float) $request->post('payment'),
            (float) $request->post('change')
        );

        $booking->extendBook(
            (int) $request->post('hours'),
            (float) $request->post('total_amount')
        );

        ExtendHistory::create([
            'booking' => $booking->code,
            'hours'   => (int) $request->post('hours'),
            'payment' => (float) $request->post('total_amount'),
        ]);

        return redirect()->route('booking.dashboard');
    }
}
