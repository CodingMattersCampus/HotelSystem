<?php

namespace CodingMatters\Api\Http\Controllers\Cash\Advance;

use App\Models\Cash\CashAdvance;
use App\Models\User\Employee;
use CodingMatters\Api\Transformers\Cash\CashAdvance\CashAdvance as CashAdvanceResource;
use CodingMatters\Api\Transformers\Cash\CashAdvance\CashAdvanceCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class GetEmployeeCashAdvanceApi extends Controller
{
    public function __invoke(Employee $employee) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new CashAdvanceCollection(
                    new CashAdvanceResource(
                        CashAdvance::whereEmployee($employee->code)->orderBy('updated_at', 'DESC')->get()
                    )
                )
            )
        )->make(true);
    }
}
