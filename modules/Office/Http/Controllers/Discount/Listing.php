<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Discount;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Listing extends Controller
{
    public function __invoke() : View
    {
        return view(
            'office::discount.listing',
            [
                'token' => Auth::guard('office')->user()->api_token,
            ]
        );
    }
}
