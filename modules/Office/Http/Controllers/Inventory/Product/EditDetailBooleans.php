<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Inventory\Product;

use App\Models\Inventory\Product;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

use CodingMatters\Office\Http\Requests\Inventory\Product\EditProductRequest;

final class EditDetailBooleans extends Controller
{
    public function __invoke(Product $product, EditProductRequest $request) : JsonResponse
    {
        $input = $request->get('toggle'); //array toggled

        return response()->json($input);
    }
}
