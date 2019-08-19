<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Cash\Remittance;

use App\Models\Cash\Remittance;
use CodingMatters\Api\Transformers\Cash\Remittance\Remittance as RemittanceResource;
use CodingMatters\Api\Transformers\Cash\Remittance\RemittanceCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllRemittancesApi extends Controller
{
    public function __invoke() : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new RemittanceCollection(
                    new RemittanceResource(
                        Remittance::latest()->get()
                    )
                )
            )
        )->setRowClass(function (array $data) {
            if ($data['remitted'] < $data['amount']) {
                return 'alert alert-danger';
            } elseif ($data['remitted'] > $data['amount']) {
                return 'alert alert-warning';
            }
        })->make(true);
    }
}
