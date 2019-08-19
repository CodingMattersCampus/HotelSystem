<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Employee;

use App\Models\User\EmployeeRole;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Settings extends Controller
{
    public function __invoke() : View
    {
        return view(
            'office::employee.setting',
            // append data here
            [
                'roles' => EmployeeRole::getRoles(),
                'token' => Auth::guard('office')->user()->api_token,
            ]
        );
    }
}
