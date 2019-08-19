<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Cash\Remittance;

use App\Models\Cash\Drawer;
use App\Models\Cash\Remittance;
use App\Models\User\Employee;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class RemittanceSummary extends Controller
{
    public function __invoke(Remittance $remittance) : View
    {
        $cashier = Employee::whereCode($remittance->cashier)->first();
        $drawer = Drawer::whereCode($remittance->drawer)->first();
        $token = Auth::guard('store')->user()->api_token;
        return view('store::cash.remittance.summary', compact('remittance', 'cashier', 'drawer', 'token'));
    }
}
