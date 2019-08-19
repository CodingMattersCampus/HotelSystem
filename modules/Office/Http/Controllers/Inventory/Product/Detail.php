<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Inventory\Product;

use App\Models\Inventory\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Detail extends Controller
{
    public function __invoke(Product $product) : View
    {
        $token = Auth::guard('office')->user()->api_token;
        return view('office::inventory.product.detail', compact('product', 'token'));
    }
}
