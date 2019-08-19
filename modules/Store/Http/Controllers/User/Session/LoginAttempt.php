<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\User\Session;

use CodingMatters\Store\Http\Requests\User\Session\StoreLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

final class LoginAttempt extends Controller
{
    public function __invoke(StoreLoginRequest $request) : RedirectResponse
    {
        if ($request->isAuthorized($request->username, $request->password, 'store')) {
            return redirect()->intended(\route('store.cash.remittance.report'));
        }

        return redirect()
            ->back()
            ->withInput($request->only('username'))
            ->withErrors('These credentials do not match our records.');
    }
}
