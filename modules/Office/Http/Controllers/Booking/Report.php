<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Booking;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Report extends Controller
{
    public function __invoke() : View
    {
        $user = Auth::guard('office')->user();

        return view('office::booking.report', ['token' => $user->api_token]);
    }
}
