<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Employee;

use App\Models\User\Employee;
use CodingMatters\Store\Http\Requests\Employee\CreateEmployeeRecordRequest;
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

        return redirect()->route('store.employee.profile', compact('employee'));
    }

    private function generateUsername(string $firstName, string $lastName, string $middleName = null)
    {
        $username = strtolower($firstName) . strtolower($lastName);

        return $username;
    }
}
