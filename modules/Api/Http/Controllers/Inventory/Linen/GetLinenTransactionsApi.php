<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Inventory\Linen;

use App\Models\Inventory\Linen;
use App\Models\Inventory\Linen\LinenTransaction;
use CodingMatters\Api\Transformers\Inventory\Linen\LinenTransaction as LinenTransactionResource;
use CodingMatters\Api\Transformers\Inventory\Linen\LinenTransactionCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetLinenTransactionsApi extends Controller
{
    public function __invoke(Linen $linen) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new LinenTransactionCollection(
                    new LinenTransactionResource(
                        LinenTransaction::where('slug', $linen->slug)->get()
                    )
                )
            )
        )->make(true);
    }
}
