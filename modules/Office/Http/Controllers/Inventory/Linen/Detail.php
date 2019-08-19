<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Inventory\Linen;

use App\Models\Inventory\Linen;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class Detail extends Controller
{
    public function __invoke(Linen $linen) : View
    {
        $token = Auth::guard('office')->user()->api_token;
        return view('office::inventory.linen.detail', compact('linen', 'token'));
    }
}
