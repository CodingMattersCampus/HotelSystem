<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\User\Session;

use CodingMatters\Booking\Http\Requests\BookingLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

final class LoginAttempt extends Controller
{
    public function __invoke(BookingLoginRequest $request) : RedirectResponse
    {
        if ($request->isAuthorized($request->username, $request->password, 'booking')) {
            if (Auth::guard('booking')->user()->isCashierOnDuty()) {
                return redirect()->intended(\route('booking.dashboard'));
            }

            return \redirect()->route('booking.cashier.confirmation');
        }

        return redirect()
            ->back()
            ->withInput($request->only('username'))
            ->withErrors('These credentials do not match our records.');
    }
}
