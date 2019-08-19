<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Booking;

use App\Models\Booking\Booking;
use App\Models\Room\Room;
use CodingMatters\Booking\Http\Requests\AdditionalOrderRequest;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

final class AdditionalOrder extends Controller
{
    public function __invoke(Room $room, AdditionalOrderRequest $request) : RedirectResponse
    {
        $user = Auth::guard('booking')->user();
        $booking = Booking::where(['room' => $room->code, 'has_checked_out' => false])->first();
        $booking->addOrders($this->collectOrders($request->post('orders')), $user);

        $user->getDrawer()->cashTransaction(
            $booking,
            "Additional orders",
            (float) $request->post('total_amount'),
            (float) $request->post('cash'),
            (float) $request->post('change')
        );

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
}
