<?php

declare(strict_types = 1);

namespace CodingMatters\Store\Http\Controllers\Inventory\Linen;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;
use App\Models\Inventory\Linen;
use App\Models\Inventory\Linen\LinenTransaction;
use CodingMatters\Store\Http\Requests\Inventory\Linen\RetrieveLaundryRequest;
use Illuminate\Database\Eloquent\Collection;

final class RetrieveLaundries extends Controller
{
    public function __invoke(RetrieveLaundryRequest $request) : View
    {
        $items = $this->collectLinens($request->post('linens'));

        $items->each(function ($item) {
            $linen = Linen::whereSlug($item['slug'])->first();

            $rem = $linen->retrieveLaundry((int) $item['quantity']);

            LinenTransaction::create([
                'slug'        => $linen->slug,
                'description' => 'Washing '. (int) $item['quantity'] .' linens',
                'out'         => $rem,
                'on'          => 'laundry',
            ]);

            LinenTransaction::create([
                'slug'        => $linen->slug,
                'description' => 'Washed stock set to storage',
                'in'          => $rem,
                'on'          => 'stocks',
            ]);
        });

        Session::flash('orders', 'Washed stock set to storage');

        return view('store::inventory.linen.listing', [
            'token' => Auth::guard('store')->user()->api_token
        ]);
    }

    private function collectLinens(?string $linens): Collection
    {
        if (is_null($linens)) {
            return Collection::make([]);
        }

        return Collection::make(json_decode($linens, true));
    }
}
