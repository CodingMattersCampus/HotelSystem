<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Booking;

use App\Models\Booking\Booking;
use App\Models\Booking\Transfers;
use CodingMatters\Api\Transformers\Booking\Transfer as TransferResource;
use CodingMatters\Api\Transformers\Booking\TransferCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetBookingTransfers extends Controller
{
    public function __invoke(Booking $booking) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new TransferCollection(
                    new TransferResource(
                        Transfers::orderBy('updated_at', 'DESC')->where(['booking' => $booking->code])->get()
                    )
                )
            )
        )->make(true);
    }
}
