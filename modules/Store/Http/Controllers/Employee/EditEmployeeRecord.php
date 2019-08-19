<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Employee;

use App\Models\User\Employee;
use CodingMatters\Store\Http\Requests\Employee\EditEmployeeRecordRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Ramsey\Uuid\Uuid;

final class EditEmployeeRecord extends Controller
{
    public function __invoke(Employee $employee, EditEmployeeRecordRequest $request) : JsonResponse
    {
        $emp = [];

        foreach ($request->except(['_token']) as $key => $value) {
            $emp[ $key ] = $value; //add filters here
        }

        if (count($emp) > 0) {
            $employee->update($emp);
            return response()->json('success');
        } else {
            return response()->json('nothing to edit');
        }
    }
}
