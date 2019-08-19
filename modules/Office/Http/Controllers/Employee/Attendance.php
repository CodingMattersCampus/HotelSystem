<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Employee;

use App\Models\User\EmployeeRole;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Attendance extends Controller
{
    public function __invoke() : View
    {
        return view(
            'office::employee.attendance',
            // append data here
            [
                'roles' => EmployeeRole::getRoles(),
                'token' => Auth::guard('office')->user()->api_token,
            ]
        );
    }
}
