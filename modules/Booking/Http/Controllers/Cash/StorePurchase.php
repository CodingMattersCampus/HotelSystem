<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Cash;

use CodingMatters\Booking\Http\Requests\StorePurchaseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

final class StorePurchase extends Controller
{
    public function __invoke() : View
    {
        return view('booking::cash.purchase');
    }

    public function deduct(StorePurchaseRequest $request) : RedirectResponse
    {
        $data = $request->only(['amount', 'reason']);
        $user = $request->user('booking');

        $drawer = $user->getDrawer();
        $drawer->deduct((float)$data['amount'], $data['reason']);

        return redirect()->back();
    }
}
