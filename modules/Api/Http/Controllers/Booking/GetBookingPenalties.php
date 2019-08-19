<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Booking;

use App\Models\Booking\Booking;
use App\Models\Booking\BookingPenalty;
use CodingMatters\Api\Transformers\Booking\BookingPenalty as BookingPenaltyResource;
use CodingMatters\Api\Transformers\Booking\BookingPenaltyCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetBookingPenalties extends Controller
{
    public function __invoke(Booking $booking) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new BookingPenaltyCollection(
                    new BookingPenaltyResource(
                        BookingPenalty::orderBy('updated_at', 'DESC')->where(['booking' => $booking->code])->get()
                    )
                )
            )
        )->make(true);
    }
}
