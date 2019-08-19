<?php

namespace CodingMatters\Booking\Http\Controllers\Api\Employee;

use App\Models\User\Employee;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class GetAllEmployees extends Controller
{
    public function __invoke() : JsonResponse
    {
        return response()->json(Employee::all()
            ->map(function (Employee $employee) {
                return [
                    'code'     => $employee->code,
                    'fullname' => $employee->fullname
                ];
            }));
    }
}
