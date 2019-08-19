<?php

namespace CodingMatters\Booking\Http\Controllers\Api\Taxi;

use App\Models\Taxi\Taxi;
use CodingMatters\Booking\Transformers\Taxi\Taxi as TaxiResource;
use CodingMatters\Booking\Transformers\Taxi\TaxiCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

class GetAllTaxisApi extends Controller
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
