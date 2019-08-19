<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Inventory\Linen;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

use App\Models\Inventory\Linen;
use App\Models\Inventory\LinenTransaction;
use CodingMatters\Office\Http\Requests\Inventory\Linen\RetrieveLaundryRequest;

final class RetrieveLaundries extends Controller
{
    public function __invoke(RetrieveLaundryRequest $request) : View
    {
    }
}
