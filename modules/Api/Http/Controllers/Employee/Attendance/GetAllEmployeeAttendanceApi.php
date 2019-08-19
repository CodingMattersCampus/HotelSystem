<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Employee\Attendance;

use App\Models\User\Employee\Attendance;
use App\Models\User\Employee;
use CodingMatters\Api\Transformers\Employee\Attendance\Attendance as AttendanceResource;
use CodingMatters\Api\Transformers\Employee\Attendance\AttendanceCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllEmployeeAttendanceApi extends Controller
{
    public function __invoke(Employee $employee) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new AttendanceCollection(
                    new AttendanceResource(
                        Attendance::whereEmployee($employee->username)->orderBy('created_at', 'DESC')->get()
                    )
                )
            )
        )->make(true);
    }
}
