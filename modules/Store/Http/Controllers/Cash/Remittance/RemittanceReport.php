<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Cash\Remittance;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class RemittanceReport extends Controller
{
    public function __invoke() : View
    {
        return view('store::cash.remittance.report', ['token' => Auth::guard('store')->user()->api_token]);
    }
}
