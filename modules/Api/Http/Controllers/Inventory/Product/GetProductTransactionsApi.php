<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Inventory\Product;

use App\Models\Inventory\Product;
use App\Models\Inventory\Product\ProductTransaction;
use CodingMatters\Api\Transformers\Inventory\Product\ProductTransaction as ProductTransactionResource;
use CodingMatters\Api\Transformers\Inventory\Product\ProductTransactionCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetProductTransactionsApi extends Controller
{
    public function __invoke(Product $product) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new ProductTransactionCollection(
                    new ProductTransactionResource(
                        ProductTransaction::where('sku', $product->sku)->orderBy('created_at', 'desc')->get()
                    )
                )
            )
        )->make(true);
    }
}
