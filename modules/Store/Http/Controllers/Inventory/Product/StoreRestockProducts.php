<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Inventory\Product;

use CodingMatters\Store\Http\Requests\Inventory\Product\StoreRestockRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

use App\Models\Inventory\Product;
use App\Models\Inventory\Product\ProductTransaction;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

final class StoreRestockProducts extends Controller
{
    public function __invoke(StoreRestockRequest $request) : RedirectResponse
    {
        $items = $this->collectProducts($request->post('requestItems'));

        $admincode = Auth::guard('store')->user()->code;

        $items->each(function ($item, $key) use ($admincode) {
            $product = Product::whereSku($item['sku'])->first();

            if ((int) $item['quantity'] < 0) {
                return; //skip all 0s or less
            }

            $restockvalue = $product->stocks > (int) $item['quantity'] ? (int) $item['quantity'] : 0; //Restock or not

            ProductTransaction::create([
                'sku'           => $product->sku,
                'description'   => "Store requests restock of " . $item['quantity'],
                'user'          => $admincode,
                'out'           => $restockvalue,
                'remaining'     => $product->stocks - $restockvalue,
                'storage'       => 'store',
            ]);

            //End of first part, prolly add stopper here if quantity is 0
            if ($restockvalue <= 0) {
                return; //jump next loop
            }
            //Verification starts here; Feature Controller for Office Verification and delivery status
            //Start second part

            $storeProduct = Product::firstOrCreate([
                'sku'       => $product->sku,
                'name'      => $product->name,
                'brand_id'  => $product->brand_id,
                'for'       => 'store',
            ]);

            $product->deductFromStocks($restockvalue);

            $storeProduct->update([
                'orderable'     => false,
                'price'         => $product->price, //update if new price
                'cost'          => $product->cost, //update if new cost
                'consumable'    => $product->consumable, //update if consumable
                'profit_margin' => $product->profit_margin, //update if new profitmargin
            ]);

            $storeProduct->reStock($restockvalue);

            ProductTransaction::create([
                'sku'           => $storeProduct->sku,
                'description'   => "Store restocks with " . $item['quantity'],
                'user'          => $admincode,
                'in'            => $restockvalue,
                'remaining'     => $storeProduct->stocks,
                'storage'       => 'store',
            ]);
            //endsecond part
        });

        return redirect()->route('store.inventory.products.listing');
    }

    private function collectProducts(?string $products): Collection
    {
        if (is_null($products)) {
            return Collection::make([]);
        }

        return Collection::make(json_decode($products, true));
    }
}
