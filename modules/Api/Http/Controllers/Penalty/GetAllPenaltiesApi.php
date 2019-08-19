<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Penalty;

use App\Models\Penalty\Penalty;
use CodingMatters\Api\Transformers\Penalty\Penalty as PenaltyResource;
use CodingMatters\Api\Transformers\Penalty\PenaltyCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllPenaltiesApi extends Controller
{
    public function __invoke() : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new PenaltyCollection(
                    new PenaltyResource(
                        Penalty::latest()->get()
                    )
                )
            )
        )->make(true);
    }
}
