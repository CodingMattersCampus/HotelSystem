<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Drawer;

use App\Models\Cash\Drawer;
use App\Models\User\Employee;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

final class StartTransaction extends Controller
{
    public function __invoke(Employee $cashier, Request $request) : RedirectResponse
    {
        Drawer::beginningTransaction($request->user(), (float)$request->post('amount'));
        return redirect()->route('booking.dashboard');
    }
}
