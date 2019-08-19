<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Booking;

use App\Models\Booking\Booking;
use CodingMatters\Api\Transformers\Booking\Booking as BookingResource;
use CodingMatters\Api\Transformers\Booking\BookingCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllBookingsApi extends Controller
{
    public function __invoke() : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new BookingCollection(
                    new BookingResource(
                        Booking::orderBy('updated_at', 'DESC')->get()
                    )
                )
            )
        )->make(true);
    }
}
