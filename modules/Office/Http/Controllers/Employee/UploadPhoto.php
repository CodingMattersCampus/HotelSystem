<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Employee;

use App\Models\User\Employee;
use CodingMatters\Office\Http\Requests\Employee\UploadPhotoRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Facades\Auth;

final class UploadPhoto extends Controller
{
    public function __invoke(Employee $employee, UploadPhotoRequest $request) : RedirectResponse
    {
        //Do edits here
        $file = $request->file('photo');
        $file->move(
            public_path('images/'. $employee->code),
            'profile.jpeg'
        );

        return redirect(route('office.employee.profile', compact('employee')));
    }
}
