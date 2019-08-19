<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Taxi;

use App\Models\Taxi\Taxi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use CodingMatters\Store\Http\Requests\Taxi\NewTaxiDetailRequest;

final class CreateTaxiDetail extends Controller
{
    public function __invoke(NewTaxiDetailRequest $request) : RedirectResponse
    {
        $data = $request->only('plate', 'name', 'make', 'model', 'color');

        Taxi::firstOrCreate(
            [
                'plate' => str_slug($data['plate'], ''),
            ],
            [
                'make'      => $data['make'],
                'model'     => $data['model'],
                'color'     => $data['color'],
                'driver'    => $data['name'],
            ]
        );

        return redirect()->route('store.taxis.listing');
    }
}
