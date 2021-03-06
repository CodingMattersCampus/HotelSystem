<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Inventory\Product;

use App\Models\Inventory\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

final class GetWarehouseProducts extends Controller
{
    public function __invoke() : JsonResponse
    {
        return response()->json(
            Product::where('for', 'warehouse')
                ->whereNotNull('set_sku')
                ->get() //Separate for inventory request
                ->reduce(function ($result, $product) {
                    return $result->push([
                        'sku'   => $product->sku,
                        'name'  => $product->name,
                        'brand' => $product->brandName(),
                        'price' => $product->price,
                    ]);
                }, collect())
        );
    }
}
