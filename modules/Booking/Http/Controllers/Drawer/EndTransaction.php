<?php

declare(strict_types = 1);

namespace CodingMatters\Booking\Http\Controllers\Drawer;

use App\Models\Cash\Drawer;
use App\Models\Inventory\InventoryRemittance;
use App\Models\Inventory\Product;
use App\Models\User\Employee;
use CodingMatters\Booking\Http\Requests\CashRemittanceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Collection;

/** @Todo Rename the class to Remit */
final class EndTransaction extends Controller
{
    public function __invoke(CashRemittanceRequest $request) : RedirectResponse
    {
        $cashier = $request->user('booking');
        $drawer = $cashier->getDrawer();

        $this->recordStocksAfterShift(
            collect(json_decode($request->post('product-remits'), true, JSON_PRETTY_PRINT)),
            $drawer,
            $cashier
        );

        Drawer::endTransaction($cashier, (float) $request->post('remitted_amount'));
        Auth::guard('booking')->logout();
        return redirect()->route('booking.login');
    }

    private function recordStocksAfterShift(Collection $inventory, Drawer $drawer, Employee $cashier): void
    {
        $inventory->each(function ($item) use ($drawer, $cashier) {
            $product = Product::whereSku($item['sku'])->first();

            InventoryRemittance::create([
                'code' => Uuid::uuid4()->toString(),
                'drawer' => $drawer->code,
                'cashier' => $cashier->code,
                'sku' => $product->sku,
                'remitted' => $item['stocks'],
                'remaining' => $product->stocks,
            ]);
        });
    }
}
