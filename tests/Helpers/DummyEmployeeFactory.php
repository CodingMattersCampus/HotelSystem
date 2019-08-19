<?php

declare(strict_types=1);

namespace Tests\Helpers;

use App\Models\User\Employee;
use App\Models\User\EmployeeRole;

trait DummyEmployeeFactory
{
    public function mockCashierEmployee(
        string $username = "cashier",
        string $firstName = "Cashier",
        string $lastName = "Test User"
    ) : Employee {

        return factory(Employee::class)->create([
            'username'      => $username,
            'first_name'    => $firstName,
            'last_name'     => $lastName,
            'role'          => EmployeeRole::CASHIER,
            'is_active'     => true,
        ]);
    }
}
