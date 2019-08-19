<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Employee;

use App\Models\User\EmployeeRole;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Settings extends Controller
{
    public function __invoke() : View
    {
        return view(
            'store::employee.setting',
            // append data here
            [
                'roles' => EmployeeRole::getRoles(),
                'token' => Auth::guard('store')->user()->api_token,
            ]
        );
    }
}
