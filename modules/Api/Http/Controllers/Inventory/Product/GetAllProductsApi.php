<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Inventory\Product;

use App\Models\Inventory\Product;
use CodingMatters\Api\Transformers\Inventory\Product\Product as ProductResource;
use CodingMatters\Api\Transformers\Inventory\Product\ProductCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllProductsApi extends Controller
{
    public function __invoke() : JsonResponse
    {

        return DataTables::of(
            new Collection(
                new ProductCollection(
                    new ProductResource(
                        Product::whereNotNull('set_sku')->orderBy('stocks', 'ASC')->get()
                    )
                )
            )
        )->setRowClass(function (array $data) {
            if ($data['stocks'] < $data['max_threshold']) {
                return 'alert alert-danger';
            } elseif ($data['stocks'] <= $data['min_threshold'] && $data['stocks'] >= $data['max_threshold']) {
                return 'alert alert-warning';
            }
        })->make(true);
    }
}
