<?php

declare(strict_types = 1);

namespace CodingMatters\Api\Http\Controllers\Cash\Remittance;

use App\Models\Cash\Remittance;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

final class GetAllRemittanceChart extends Controller
{
    public function __invoke() : JsonResponse
    {
        $months = collect([
            "January" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "February" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "March" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "April" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "May" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "June" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "July" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "August" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "September" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "October" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "November" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
            "December" => [
                'remitted' => 0.00,
                'amount' => 0.00
            ],
        ]);

        $remittance = Remittance::whereYear('created_at', date('Y'))
            ->orderBy('created_at', "asc")->get()
            ->groupBy(function ($index) {
                return $index->created_at->format("F");
            })
            ->reduce(function ($result, $group) {
                return $result->put($group->first()->created_at->format('F'), collect([
                    'remitted'  => $group->sum('remitted'),
                    'amount'    => $group->sum('amount'),
                    'deficit'   => $group->sum('deficit'),
                    'excess'    => $group->sum('excess'),
                 ]));
            }, collect());

        return response()->json($months->merge($remittance));
    }
}
