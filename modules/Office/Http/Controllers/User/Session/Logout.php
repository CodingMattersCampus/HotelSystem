<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\User\Session;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

final class Logout extends Controller
{
    public function __invoke() : RedirectResponse
    {
        Auth::guard('office')->logout();
        return redirect()->route('office.login');
    }
}
