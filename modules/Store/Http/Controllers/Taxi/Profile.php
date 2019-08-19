<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Taxi;

use App\Models\Taxi\Taxi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Profile extends Controller
{
    public function __invoke(Taxi $taxi) : View
    {
        return view(
            'store::taxi.profile',
            [
                "taxi"  => $taxi,
                'token' => Auth::guard('store')->user()->api_token,
            ]
        );
    }
}
