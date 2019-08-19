<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Inventory\Product;

use App\Models\Inventory\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

use Illuminate\Database\Eloquent\Collection;
use CodingMatters\Store\Http\Requests\Inventory\Product\EditProductRequest;

final class EditDetailBooleans extends Controller
{
    public function __invoke(Product $product, EditProductRequest $request) : JsonResponse
    {
        $input = $request->get('toggle'); //array toggled

        $product->update($input); //expound and secure later

        return response()->json($product);
    }
}
