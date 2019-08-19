<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Penalty;

use App\Models\Penalty\Penalty;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use CodingMatters\Store\Http\Requests\Penalty\NewPenaltyRequest;

final class CreatePenalty extends Controller
{
    public function __invoke(NewPenaltyRequest $request) : RedirectResponse
    {
        $data = $request->only('name', 'rate');

        Penalty::firstOrCreate(
            $data,
            [
                'slug' => str_slug($data['name'], '-')
            ]
        );

        return redirect()->route('store.penalties.listing');
    }
}
