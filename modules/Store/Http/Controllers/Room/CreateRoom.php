<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Room;

use App\Models\Room\Room;
use CodingMatters\Store\Http\Requests\Room\CreateRoomRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

final class CreateRoom extends Controller
{
    public function __invoke(CreateRoomRequest $request) : RedirectResponse
    {
        $data = $request->only('name', 'type', 'booking_rate', 'booking_duration');
        $data['code'] = Uuid::uuid4()->toString();
        $data['type'] = strtolower($data['type']);

        $room = Room::firstOrCreate($data);

        return redirect()->route('store.room.settings', compact('room'));
    }
}
