<?php

declare(strict_types = 1);

namespace CodingMatters\Office\Http\Controllers\Room;

use App\Models\Room\Room;
use CodingMatters\Office\Http\Requests\Room\CreateRoomRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Ramsey\Uuid\Uuid;

final class CreateRoom extends Controller
{
    public function __invoke(CreateRoomRequest $request) : RedirectResponse
    {
        $data = $request->only('name', 'type');
        $data['code'] = Uuid::uuid4()->toString();

        $room = Room::firstOrCreate($data);

        return redirect()->route('office.room.settings', compact('room'));
    }
}
