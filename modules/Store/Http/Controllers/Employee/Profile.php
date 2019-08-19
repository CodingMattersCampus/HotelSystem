<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Employee;

use App\Models\User\Employee;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

final class Profile extends Controller
{
    public function __invoke(Employee $employee) : View
    {
        return view(
            'store::employee.profile',
            [
                'employee' => $employee,
                'token' => Auth::guard('store')->user()->api_token
            ]
        );
    }
}
