<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

final class CashierOnDuty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $request->user()->isCashierOnDuty()) {
            return redirect()->route('booking.cashier.confirmation');
        }

        return $next($request);
    }
}
