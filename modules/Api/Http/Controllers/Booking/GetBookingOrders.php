<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Booking;

use App\Models\Booking\Booking;
use App\Models\Booking\Order;
use CodingMatters\Api\Transformers\Booking\Order as OrderResource;
use CodingMatters\Api\Transformers\Booking\OrderCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetBookingOrders extends Controller
{
    public function __invoke(Booking $booking) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new OrderCollection(
                    new OrderResource(
                        Order::orderBy('updated_at', 'DESC')->where(['booking' => $booking->code])->get()
                    )
                )
            )
        )->make(true);
    }
}
