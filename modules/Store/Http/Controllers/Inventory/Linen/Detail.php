<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Inventory\Linen;

use App\Models\Inventory\Linen;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Detail extends Controller
{
    public function __invoke(Linen $linen) : View
    {
        $token = Auth::guard('store')->user()->api_token;
        return view('store::inventory.linen.detail', compact('linen', 'token'));
    }
}
