<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Room;

use App\Models\Booking\Booking;
use App\Models\Booking\Transfers;
use App\Models\Room\Room;
use App\Models\Room\RoomStatus;
use CodingMatters\Booking\Http\Requests\Room\TransferRoomRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

final class TransferRoom extends Controller
{
    public function __invoke(Room $room, TransferRoomRequest $request) : RedirectResponse
    {
        $cashier = $request->user('booking');

        $booking = Booking::where(['room' => $room->code, 'has_checked_out' => false])->first();
        //Payment?
        $cashier->getDrawer()->cashTransaction(
            $booking,
            "Transfer Room Transaction with from {$request->post('current')} to {$request->post('booking-rate')}",
            (float) $request->post('total_amount'),
            (float) $request->post('cash'),
            (float) $request->post('change')
        );

        $room->toLaundryLinens();
        //Change linens on room?
        $room->updateStatusTo(RoomStatus::MAINTENANCE);

        $new_room = Room::where('code', $request->post('room'))->first();

        $new_room->updateStatusTo(RoomStatus::OCCUPIED);

        Transfers::create([
            'code'     => Uuid::uuid4()->toString(),
            'booking'  => $booking->code,
            'from'     => $room->name,
            'to'       => $new_room->name,
            'employee' => $cashier->code,
            'reason'   => $request->post('reason'),
            'payment'  => (float) $request->post('total_amount')
        ]);

        $booking->changeRoom(
            $new_room,
            (int) $request->post('reset-time'),
            (float) $request->post('total_amount')
        );

        return redirect()->route('booking.dashboard');
    }
}
