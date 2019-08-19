<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Booking;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Report extends Controller
{
    public function __invoke() : View
    {
        $user = Auth::guard('store')->user();

        return view('store::booking.report', ['token' => $user->api_token]);
    }
}
