<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Penalty;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Listing extends Controller
{
    public function __invoke() : View
    {
        return view(
            'store::penalty.listing',
            [
                'token' => Auth::guard('store')->user()->api_token,
            ]
        );
    }
}
