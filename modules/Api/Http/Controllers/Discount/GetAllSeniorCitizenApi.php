<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Discount;

use App\Models\Discount\SeniorCitizen;
use CodingMatters\Api\Transformers\Discount\SeniorCitizen as SeniorCitizenResource;
use CodingMatters\Api\Transformers\Discount\SeniorCitizenCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllSeniorCitizenApi extends Controller
{
    public function __invoke() : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new SeniorCitizenCollection(
                    new SeniorCitizenResource(
                        SeniorCitizen::orderBy('last_name', 'DESC')->get()
                    )
                )
            )
        )->make(true);
    }
}
