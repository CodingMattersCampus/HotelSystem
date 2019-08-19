<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Purchase;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;

final class RecordPurchases extends Controller
{
    public function __invoke() : RedirectResponse
    {
        return redirect()->route('store.inventory.products.listing');
    }
}
