<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Inventory\Product;

use App\Models\Inventory\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

use CodingMatters\Store\Http\Requests\Inventory\Product\EditProductRequest;

final class EditDetail extends Controller
{
    public function __invoke(Product $product, EditProductRequest $request) : View
    {
        Session::flash('editmessage', "Product was edited");

        $token = Auth::guard('store')->user()->api_token;
        return view('store::inventory.product.detail', compact('product', 'token'));
    }
}
