<?php

namespace CodingMatters\Booking\Http\Controllers\Api\Penalty;

use App\Models\Penalty\Penalty;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class GetAllPenalties extends Controller
{
    public function __invoke() : JsonResponse
    {
        return response()->json(Penalty::select('id', 'name', 'rate')->get());
    }
}
