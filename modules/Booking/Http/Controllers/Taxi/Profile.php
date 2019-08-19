<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Taxi;

use App\Models\Taxi\Taxi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Profile extends Controller
{
    public function __invoke(Taxi $taxi) : View
    {
        return view('booking::taxi.profile', compact('taxi'));
    }
}
