<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Room;

use App\Models\Booking\Booking;
use App\Models\Room\Room;
use CodingMatters\Api\Transformers\Booking\Booking as BookingResource;
use CodingMatters\Api\Transformers\Booking\BookingCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetBookingsApi extends Controller
{
    public function __invoke(Room $room) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new BookingCollection(
                    new BookingResource(
                        Booking::whereRoom($room->code)->orderBy('updated_at', 'DESC')->get()
                    )
                )
            )
        )->make(true);
    }
}
