<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Transformers\Cash\Remittance;

use App\Models\Cash\Remittance;

use Illuminate\Http\Resources\Json\ResourceCollection;

final class AggregateByNameCollection extends ResourceCollection
{
    public function toArray($request)
    {
        $this->collection->transform(function (Remittance $remittance) {
            return [
                'remitted'      => $remittance->remittedAmount(),
            ];
        });

        return [
            $this->collection->sum('remitted'),
        ];
    }
}
