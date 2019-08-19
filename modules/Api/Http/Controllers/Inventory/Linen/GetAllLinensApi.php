<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Inventory\Linen;

use App\Models\Inventory\Linen;
use CodingMatters\Api\Transformers\Inventory\Linen\Linen as LinenResource;
use CodingMatters\Api\Transformers\Inventory\Linen\LinenCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllLinensApi extends Controller
{
    public function __invoke() : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new LinenCollection(
                    new LinenResource(
                        Linen::orderBy('updated_at', 'desc')->get()
                    )
                )
            )
        )->make(true);
    }
}
