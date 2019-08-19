<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Inventory\Product;

use App\Models\Inventory\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

use CodingMatters\Office\Http\Requests\Inventory\Product\EditProductRequest;

final class EditDetail extends Controller
{
    public function __invoke(Product $product, EditProductRequest $request) : View
    {
        Session::flash('editmessage', "Product was edited");

        $token = Auth::guard('office')->user()->api_token;
        return view('office::inventory.product.detail', compact('product', 'token'));
    }
}
