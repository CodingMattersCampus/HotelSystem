<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Cash;

use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

final class CashTransactions extends Controller
{
    public function __invoke() : View
    {
        return view("booking::cash.transaction");
    }
}
