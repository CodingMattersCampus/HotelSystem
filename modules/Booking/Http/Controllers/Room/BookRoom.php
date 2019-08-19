<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Room;

use App\Events\Booking\BookedRoom;
use App\Helpers\SystemTime;
use App\Models\Booking\Booking;
use App\Models\Booking\Order;
use App\Models\Room\Room;
use App\Models\Room\RoomStatus;
use CodingMatters\Booking\Http\Requests\Room\BookRoomRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;

final class BookRoom extends Controller
{
    public function __invoke(Room $room, BookRoomRequest $request) : RedirectResponse
    {
        $user = Auth::guard('booking')->user();

        $hours = 3;
        switch (strtoupper($request->post('rate_type'))) {
            case 'ST':
                $hours = 3;
                break;
            case 'HD':
                $hours = 12;
                break;
            case 'WD':
                $hours = 24;
                break;
        }

        $booking = Booking::firstOrCreate([
            'room'          => $room->code,
            'code'          => Uuid::uuid4()->toString(),
            'checkin'       => $currentTime = now('Asia/Manila'),
            'timeout'       => $currentTime->copy()->addHours($hours),
            'checkin_by'    => $user->code,
            'rate'          => $this->computeBookingRate($request),
        ]);

        $user->getDrawer()->cashTransaction(
            $booking,
            "Initial booking transaction",
            (float) $request->post('total_amount'),
            (float) $request->post('cash'),
            (float) $request->post('change')
        );

        if (! is_null($taxi = $request->post('plate'))) {
            $booking->withTaxi($taxi, $request->post('driver'));

            $user->getDrawer()->cashTransaction(
                $booking,
                "Taxi Referral Fee: {$taxi}",
                0,
                0,
                25
            );
        }

        if (! is_null($sc = $request->post('sc_id'))) {
            $booking->scDiscount(
                $sc,
                $request->post('sc_first_name'),
                $request->post('sc_middle_name'),
                $request->post('sc_last_name')
            );
        }

        $booking->addOrders($this->collectOrders($request->post('orders')), $user);

        $room->updateStatusTo(RoomStatus::OCCUPIED);
        //Linens Starts here
        $linens = [
            'blanket' => $request->post('room_blanket'),
            'bedsheet' => $request->post('room_bedsheet'),
            'pillow' => $request->post('room_pillow'),
            'towel' => $request->post('room_towel')
        ];

        foreach ($linens as $linen => $count) {
            $room->addLinen($linen, (int) $count);
        }
        //ends here

        event(new BookedRoom($booking, $room, $user));

        return redirect()->route('booking.dashboard');
    }

    /**
     * @param string|null $orders
     * @return Collection
     */
    private function collectOrders(?string $orders): Collection
    {
        if (is_null($orders)) {
            return Collection::make([]);
        }

        return Collection::make(json_decode($orders, true));
    }

    /**
     * @param BookRoomRequest $request
     * @return array|float|string|null
     */
    private function computeBookingRate(BookRoomRequest $request)
    {
        return $request->post('booking_rate') ?? 0.00;
    }
}
