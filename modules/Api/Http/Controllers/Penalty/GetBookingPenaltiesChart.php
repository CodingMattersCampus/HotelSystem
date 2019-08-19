<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Penalty;

use App\Models\Booking\BookingPenalty;
use CodingMatters\Api\Transformers\Penalty\ChartPenaltyCollection;
use Illuminate\Routing\Controller;
use Carbon\Carbon;

final class GetBookingPenaltiesChart extends Controller
{
    public function __invoke() : ChartPenaltyCollection
    {

        $penalties = BookingPenalty::whereYear('created_at', date('Y'))
            ->orderBy('updated_at', 'DESC')
            ->get()
            ->groupBy(function ($penalty) {
                return Carbon::parse($penalty->created_at)->format('F');
            });

        return new ChartPenaltyCollection($penalties);
    }
}
