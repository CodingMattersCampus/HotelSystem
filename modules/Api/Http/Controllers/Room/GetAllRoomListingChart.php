<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Room;

use App\Models\Room\RoomTransaction;
// use CodingMatters\Api\Transformers\Room\RoomTransaction as RoomTransactionResource;
use CodingMatters\Api\Transformers\Room\RoomTransactionCollection;
use Illuminate\Routing\Controller;
use App\Helpers\SystemTime;
use Carbon\Carbon;

final class GetAllRoomListingChart extends Controller
{
    use SystemTime;

    public function __invoke() : RoomTransactionCollection
    {
        return new RoomTransactionCollection(
            RoomTransaction::
                whereYear('created_at', $this->getCurrentTime()->year)
                ->whereNotIn('status', ['available', 'cleaning'])
                ->orderBy('created_at', 'DESC')
                ->get()
                ->groupBy(function (RoomTransaction $roomTransaction) {
                    return $roomTransaction->getRoomName();
                })
        );
    }
}
