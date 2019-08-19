<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Room;

use App\Models\Room\Room;
use App\Models\Room\RoomTransaction;
use CodingMatters\Api\Transformers\Room\RoomTransaction as RoomTransactionResource;
use CodingMatters\Api\Transformers\Room\YearRoomTransactionCollection;
use Illuminate\Routing\Controller;
use App\Helpers\SystemTime;
use Carbon\Carbon;

final class GetYearRoomListingChart extends Controller
{
    use SystemTime;
    public function __invoke(Room $room) : YearRoomTransactionCollection
    {
        // $month = $this->getCurrentTime()->format('m'); //Use This as filter queryquery

        return new YearRoomTransactionCollection(
            RoomTransaction::whereYear('created_at', $this->getCurrentTime()->year)
                ->where('room', $room->code)
                ->whereNotIn('status', ['available', 'cleaning'])
                ->orderBy('created_at', 'DESC')
                ->get()
                ->groupBy(function ($d) {
                    return Carbon::parse($d->created_at)->format('F');
                })
        );
    }
}
