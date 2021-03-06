<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\User\Profile;

use CodingMatters\Store\Http\Requests\User\Profile\ChangePasswordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

final class ChangePassword extends Controller
{
    public function __invoke(ChangePasswordRequest $request) : RedirectResponse
    {
        $request->user()->update([
            'password' => Hash::make($request->post('new_password'))
        ]);

        return redirect()->route('store.user.profile');
    }
}
