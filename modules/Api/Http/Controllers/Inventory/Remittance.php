<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Inventory;

use App\Models\Cash\Drawer;
use App\Models\Inventory\InventoryRemittance;
use CodingMatters\Api\Transformers\Inventory\InventoryRemittance as InventoryRemittanceResource;
use CodingMatters\Api\Transformers\Inventory\InventoryRemittanceCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class Remittance extends Controller
{
    public function __invoke(Drawer $drawer) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new InventoryRemittanceCollection(
                    new InventoryRemittanceResource(
                        InventoryRemittance::where(['drawer' => $drawer->code])->get()
                    )
                )
            )
        )->setRowClass(function (array $data) {
            if ($data['remitted'] < $data['remaining']) {
                return 'alert alert-danger';
            } elseif ($data['remitted'] > $data['remaining']) {
                return 'alert alert-warning';
            }
        })->make(true);
    }
}
