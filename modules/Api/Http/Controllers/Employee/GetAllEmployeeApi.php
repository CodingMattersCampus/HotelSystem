<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Employee;

use App\Models\User\Employee;
use CodingMatters\Api\Transformers\Employee\Employee as EmployeeResource;
use CodingMatters\Api\Transformers\Employee\EmployeeCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllEmployeeApi extends Controller
{
    public function __invoke() : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new EmployeeCollection(
                    new EmployeeResource(
                        Employee::orderBy('last_name', 'DESC')->get()
                    )
                )
            )
        )->make(true);
    }
}
