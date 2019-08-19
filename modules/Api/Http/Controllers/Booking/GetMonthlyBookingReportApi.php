<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Booking;

use App\Models\Booking\Booking;
use CodingMatters\Api\Transformers\Booking\AggregateCollection;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

final class GetMonthlyBookingReportApi extends Controller
{
    public function __invoke(Request $request) : AggregateCollection
    {
        $list = Booking::whereYear('created_at', date('Y'))
                ->whereMonth('created_at', $request->post('month'))
                ->get();
        return new AggregateCollection($list); //Calendar list
    }
}
