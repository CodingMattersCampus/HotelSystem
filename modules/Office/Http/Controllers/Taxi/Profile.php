<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Taxi;

use App\Models\Taxi\Taxi;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Profile extends Controller
{
    public function __invoke(Taxi $taxi) : View
    {
        $token = Auth::guard('office')->user()->api_token;

        return view('office::taxi.profile', compact('taxi', 'token'));
    }
}
