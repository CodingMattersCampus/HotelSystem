<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Room;

use App\Models\Room\Room;
use CodingMatters\Api\Transformers\Room\Room as RoomResource;
use CodingMatters\Api\Transformers\Room\RoomCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetAllRoomApi extends Controller
{
    public function __invoke() : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new RoomCollection(
                    new RoomResource(
                        Room::all()
                    )
                )
            )
        )->make(true);
    }
}
