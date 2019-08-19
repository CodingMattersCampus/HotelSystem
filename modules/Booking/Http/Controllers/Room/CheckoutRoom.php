<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Room;

use App\Events\Booking\CheckoutRoom as CheckoutRoomEvent;
use App\Helpers\SystemTime;
use App\Models\Booking\Booking;
use App\Models\Room\Room;
use App\Models\Room\RoomStatus;
use CodingMatters\Booking\Http\Requests\Room\CheckoutRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

final class CheckoutRoom extends Controller
{
    use SystemTime;

    public function __invoke(Room $room, CheckoutRequest $request) : RedirectResponse
    {
        $employee = Auth::guard('booking')->user();
        $room->updateStatusTo(RoomStatus::CLEANING);

        $booking = Booking::where([
            'room'              => $room->code,
            'checkout'          => null,
            'checkout_by'       => null,
            'has_checked_out'   => false,
        ])->first();

        if (! is_null($request->post('penalties'))) {
            $penalties = Collection::make(json_decode($request->post('penalties'), true));
            $booking->withPenalties($penalties, $employee);
            $employee->getDrawer()->cashTransaction(
                $booking,
                "With Penalties",
                (float) $request->post('total_amount'),
                (float) $request->post('cash'),
                (float) $request->post('change')
            );
        }

        $booking->update([
            'checkout'          => $this->getCurrentTime(),
            'checkout_by'       => $employee->code,
            'has_checked_out'   => true,
        ]);

        event(new CheckoutRoomEvent($booking, $room, $employee));

        return redirect()->route('booking.dashboard');
    }


    /**
     * @param string|null $penalties
     * @return Collection
     */
    private function collectPenalties(?string $penalties): Collection
    {
        if (is_null($penalties)) {
            return Collection::make([]);
        }

        return Collection::make(json_decode($penalties, true));
    }
}
