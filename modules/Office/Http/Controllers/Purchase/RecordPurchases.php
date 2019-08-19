<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Purchase;

use CodingMatters\Office\Http\Requests\RecordPurchaseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

use App\Models\Inventory\Product;
use App\Models\Inventory\Product\ProductTransaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

final class RecordPurchases extends Controller
{
    public function __invoke(RecordPurchaseRequest $request) : RedirectResponse
    {
        $items = $this->collectProducts($request->post('purchases'));

        $admincode = Auth::guard('office')->user()->code;
        $invoice = $request->post('or_number');

        $items->each(function ($item, $key) use ($invoice, $admincode) {
            $cost = (float) $item['cost'];
            $quantity = (int) $item['quantity'];

            $set = Product::whereSku($item['sku'])->first();
            $set->updatePrice((float) $cost / $quantity);
            $set->reStock($quantity);

            ProductTransaction::create([
                'sku'           => $set->sku,
                'description'   => "Warehouse restock of " . $quantity . " through repurchasing",
                'user'          => $admincode,
                'invoice'       => $invoice,
                'price'         => $set->price,
                'cost'          => (float) $cost,
                'in'            => $quantity,
                'remaining'     => $set->stocks,
                'storage'       => 'warehouse',
            ]);

            // ONLY update prices for the individual SKU
            $productCost = $set->cost / $set->set_quantity;
            $product = Product::whereSku($set->set_sku)->first();
            $product->updatePrice($productCost);

            ProductTransaction::create([
                'sku'           => $product->sku,
                'description'   => "Updated pricing",
                'user'          => $admincode,
                'invoice'       => $invoice,
                'price'         => $product->price,
                'cost'          => (float) $productCost,
                'in'            => 0,
                'remaining'     => $product->stocks,
                'storage'       => 'warehouse',
            ]);
        });

        return redirect()->route('office.inventory.products.listing');
    }

    private function collectProducts(?string $products): Collection
    {
        if (is_null($products)) {
            return Collection::make([]);
        }

        return Collection::make(json_decode($products, true));
    }
}
