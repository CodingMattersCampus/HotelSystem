<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Inventory\Linen;

use App\Models\Inventory\Linen;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

final class GetAllLaundries extends Controller
{
    public function __invoke() : JsonResponse
    {
        return response()->json(
            Linen::where('laundry', '>', 0)
                ->get()
                ->reduce(function ($result, $linen) {
                    return $result->push([
                        'name'  => $linen->name,
                        'laundry' => $linen->laundry,
                    ]);
                }, collect())
        );
    }
}
