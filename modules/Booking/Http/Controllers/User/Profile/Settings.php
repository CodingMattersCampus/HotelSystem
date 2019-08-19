<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\User\Profile;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

final class Settings extends Controller
{
    public function __invoke() : View
    {
        $user = Auth::guard('booking')->user();

        return view('booking::user.profile', compact('user'));
    }
}
