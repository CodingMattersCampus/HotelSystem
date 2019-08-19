<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Booking;

use App\Models\Booking\Booking;
use App\Models\Booking\ExtendHistory;
use CodingMatters\Api\Transformers\Booking\Extensions as ExtensionsResource;
use CodingMatters\Api\Transformers\Booking\ExtensionsCollection;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Yajra\DataTables\DataTables;

final class GetBookingExtensions extends Controller
{
    public function __invoke(Booking $booking) : JsonResponse
    {
        return DataTables::of(
            new Collection(
                new ExtensionsCollection(
                    new ExtensionsResource(
                        ExtendHistory::orderBy('updated_at', 'DESC')->where(['booking' => $booking->code])->get()
                    )
                )
            )
        )->make(true);
    }
}
