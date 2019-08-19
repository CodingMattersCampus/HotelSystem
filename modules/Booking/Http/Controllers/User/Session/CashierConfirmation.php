<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\User\Session;

use App\Models\Cash\Drawer;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class CashierConfirmation extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! Auth::guard('booking')->user()->isCashierOnDuty()) {
                return $next($request);
            }

            return redirect()->route('booking.dashboard');
        });
    }

    public function __invoke() : View
    {
        $user = Auth::guard('booking')->user();
        $cash = Drawer::BEGINNING_BALANCE;
        return view('booking::user.confirmation', compact('user', 'cash'));
    }
}
