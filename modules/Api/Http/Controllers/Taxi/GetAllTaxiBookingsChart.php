<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Taxi;

use App\Models\Taxi\Taxi;
use App\Models\Taxi\TaxiBooking;
use CodingMatters\Api\Transformers\Taxi\TaxiBooking as TaxiBookingResource;
use CodingMatters\Api\Transformers\Taxi\TaxiBookingCollection;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

final class GetAllTaxiBookingsChart extends Controller
{
    public function __invoke() : TaxiBookingCollection
    {

        $booking = TaxiBooking::whereYear('created_at', date('Y'))
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->groupBy(function ($taxi) {
                return Carbon::parse($taxi->created_at)->format('F');
            });

        return new TaxiBookingCollection($booking);
    }
}
