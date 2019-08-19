<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Employee;

use App\Models\User\Employee;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

final class Profile extends Controller
{
    public function __invoke(Employee $employee) : View
    {
        $token = Auth::guard('office')->user()->api_token;
        return view('office::employee.profile', compact('employee', 'token'));
    }
}
