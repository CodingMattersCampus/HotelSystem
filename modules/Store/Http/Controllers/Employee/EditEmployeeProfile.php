<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Employee;

use App\Models\User\Employee;
use CodingMatters\Store\Http\Requests\Employee\EditEmployeeRecordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

final class EditEmployeeProfile extends Controller
{
    public function __invoke(Employee $employee, EditEmployeeRecordRequest $request) : RedirectResponse
    {
        $emp = [];

        foreach ($request->except(['_token']) as $key => $value) {
            $emp[ $key ] = $value; //add filters here
        }

        if (count($emp) > 0) {
            $employee->update($emp);
            Session::flash('success', 'Profile edited');
        }

        return redirect(route('office.employee.profile', compact('employee')));
    }
}
