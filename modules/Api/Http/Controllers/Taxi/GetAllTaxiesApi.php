<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Taxi;

use App\Models\Taxi\Taxi;
use CodingMatters\Api\Transformers\Taxi\Taxi as TaxiResource;
use CodingMatters\Api\Transformers\Taxi\TaxiCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllTaxiesApi extends Controller
{
    public function __invoke() : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new TaxiCollection(
                    new TaxiResource(
                        Taxi::orderBy('updated_at', 'DESC')->get()
                    )
                )
            )
        )->make(true);
    }
}
