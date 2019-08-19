<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Api\Inventory\Product;

use App\Models\Inventory\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

final class GetAllOrderableProducts extends Controller
{
    public function __invoke() : JsonResponse
    {
        return response()->json(
            Product::where('for', 'store')->whereOrderable(true)->get()
                ->filter(function ($product) {
                    if ($product->isActive()) {
                        return $product;
                    }
                })
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
