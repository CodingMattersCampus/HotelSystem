<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Taxi;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Listing extends Controller
{
    public function __invoke() : View
    {
        return view(
            'booking::taxi.listing',
            [
                'token' => Auth::guard('booking')->user()->api_token,
            ]
        );
    }
}
