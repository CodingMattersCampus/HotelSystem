<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\User\Session;

use CodingMatters\Office\Http\Requests\User\Session\OfficeLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

final class LoginAttempt extends Controller
{
    public function __invoke(OfficeLoginRequest $request) : RedirectResponse
    {
        if ($request->isAuthorized($request->username, $request->password, 'office')) {
            return redirect()->intended(\route('office.sales.report'));
        }

        return redirect()
            ->back()
            ->withInput($request->only('username'))
            ->withErrors('These credentials do not match our records.');
    }
}
