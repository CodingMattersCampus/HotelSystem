<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Sales;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Report extends Controller
{
    public function __invoke() : View
    {
        return view('office::sales.report', ['token' => Auth::guard('office')->user()->api_token]);
    }
}
