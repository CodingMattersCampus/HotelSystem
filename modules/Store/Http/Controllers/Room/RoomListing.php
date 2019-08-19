<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Room;

use App\Models\Room\RoomType;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

final class RoomListing extends Controller
{
    public function __invoke() : View
    {
        $token = Auth::guard('store')->user()->api_token;
        $types = RoomType::getTypes();
        return view('store::room.listing', compact('types', 'token'));
    }
}
