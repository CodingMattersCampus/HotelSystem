<?php

namespace CodingMatters\Booking\Http\Controllers\Api\Cash;

use App\Models\Cash\CashAdvance;
use App\Models\Cash\ApprovalType;
use CodingMatters\Booking\Transformers\Cash\CashAdvance\CashAdvance as CashAdvanceResource;
use CodingMatters\Booking\Transformers\Cash\CashAdvance\CashAdvanceCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class GetApprovedCashAdvanceApi extends Controller
{
    public function __invoke() : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new CashAdvanceCollection(
                    new CashAdvanceResource(
                        CashAdvance::whereIn('approval', [ApprovalType::APPROVED, ApprovalType::REJECTED])
                            ->orderBy('updated_at', 'DESC')->get()
                    )
                )
            )
        )->make(true);
    }
}
