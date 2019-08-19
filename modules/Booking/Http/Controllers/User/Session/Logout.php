<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\User\Session;

use App\Models\Cash\Drawer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

final class Logout extends Controller
{
    public function __invoke() : RedirectResponse
    {
        Auth::guard('booking')->logout();
        return redirect()->route('booking.login');
    }

    public function discontinue() : RedirectResponse
    {
        Auth::guard('booking')->logout();
        return redirect()->route('booking.login');
    }
}
