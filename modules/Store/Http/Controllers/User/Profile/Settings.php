<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\User\Profile;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

final class Settings extends Controller
{
    public function __invoke() : View
    {
        $user = Auth::guard('store')->user();
        return view('store::user.profile', compact('user'));
    }
}
