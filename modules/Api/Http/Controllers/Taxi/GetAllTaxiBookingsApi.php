<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Taxi;

use App\Models\Booking\Booking;
use App\Models\Taxi\Taxi;
use App\Models\Taxi\TaxiBooking;
use CodingMatters\Api\Transformers\Booking\Booking as BookingResource;
use CodingMatters\Api\Transformers\Booking\BookingCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllTaxiBookingsApi extends Controller
{
    public function __invoke(Taxi $taxi) : JsonResponse
    {
        $bookings = Booking::whereYear('created_at', date('Y'))
            ->orderBy('updated_at', 'DESC')
            ->whereIn('code', TaxiBooking::select('booking')->whereTaxi($taxi->plate)->get())
            ->get();

        return DataTables::of(new Collection(new BookingCollection(new BookingResource($bookings))))->make(true);
    }
}
