<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Cash\Remittance;

use App\Models\Cash\Remittance;
use CodingMatters\Api\Transformers\Cash\Remittance\ChartRemittanceCollection as RemittanceCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use App\Helpers\SystemTime;
use Carbon\Carbon;

final class GetCurrentYearRemittancesApi extends Controller
{
    use SystemTime;

    public function __invoke() : RemittanceCollection
    {
        return new RemittanceCollection(
            Remittance::whereYear('created_at', $this->getCurrentTime())
                        ->latest()
                        ->get()
                        ->groupBy(function ($d) {
                            return Carbon::parse($d->created_at)->format('m');
                        })
        );
    }
}
