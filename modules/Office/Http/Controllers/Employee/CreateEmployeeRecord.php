<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Employee;

use App\Models\User\Employee;
use CodingMatters\Office\Http\Requests\Employee\CreateEmployeeRecordRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

final class CreateEmployeeRecord extends Controller
{
    public function __invoke(CreateEmployeeRecordRequest $request) : RedirectResponse
    {
        $data = $request->only('first_name', 'middle_name', 'last_name', 'role');
        $data['code'] = Uuid::uuid4()->toString();
        $data['username'] = $this->generateUsername($data['first_name'], $data['last_name'], $data['middle_name']);
        $data['password'] = Hash::make($data['username']);

        $employee = Employee::firstOrCreate($data);

        return redirect()->route('office.employee.profile', compact('employee'));
    }

    private function generateUsername(string $firstName, string $lastName, string $middleName = null) : string
    {
        $username = strtolower($firstName) . strtolower($lastName);

        return $username;
    }
}
