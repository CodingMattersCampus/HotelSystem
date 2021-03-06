<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Booking;

use App\Models\Booking\Booking;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Summary extends Controller
{
    public function __invoke(Booking $booking) : View
    {
        $token = Auth::guard('store')->user()->api_token;
        return view('store::booking.summary', compact('booking', 'token'));
    }
}
