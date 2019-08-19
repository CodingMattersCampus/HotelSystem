<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Cash\Transaction;

use App\Models\Cash\CashTransaction;
use App\Models\Cash\Drawer;
use CodingMatters\Api\Transformers\Cash\CashTransaction as CashTransactionResource;
use CodingMatters\Api\Transformers\Cash\CashTransactionCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetCashDrawerTransactions extends Controller
{
    public function __invoke(Drawer $drawer) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new CashTransactionCollection(
                    new CashTransactionResource(
                        CashTransaction::whereDrawer($drawer->code)->orderBy('created_at', 'desc')->get()
                    )
                )
            )
        )->make(true);
    }
}
