<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;
use App\Models\Inventory\Brand;

final class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() : void
    {
        foreach ($this->brands() as $brand)
            if (! Brand::whereCode($brand['code'])->first()) {
                $brand['code'] = strtoupper($brand['code']);
                $brand['name'] = ucwords($brand['name']);
                $brand['slug'] = str_slug($brand['name']);
                Brand::firstOrCreate($brand);
            }
    }

    private function brands () : array
    {
        return [
            [
                'code' => "ARGNTN",
                'name' => "Argentina",
            ],
            [
                'code' => "AJINMT",
                'name' => "Ajinomoto",
            ],
            [
                'code' => "CRMSLK",
                'name' => "Cream Silk",
            ],
            [
                'code' => "CFREE",
                'name' => "Carefree",
            ],
            [
                'code' => "CRMALL",
                'name' => "Cream All",
            ],
            [
                'code' => "MODESS",
                'name' => "Modess",
            ],
            [
                'code' => "LUKYME",
                'name' => "Lucky Me",
            ],
            [
                'code' => "COCACOLA",
                'name' => "Coca cola",
            ],
            [
                'code' => "COLGAT",
                'name' => "Colgate",
            ],
            [
                'code' => "SANMGL",
                'name' => "San Miguel",
            ],
            [
                'code' => "GTORD",
                'name' => "Getorade",
            ],
            [
                'code' => "TRUST",
                'name' => "Trust",
            ],
            [
                'code' => "NSCAFE",
                'name' => "Nescafe",
            ],
            [
                'code' => "MILO",
                'name' => "Milo",
            ],
            [
                'code' => "PHCARE",
                'name' => "PH Care",
            ],
            [
                'code' => "GTSBY",
                'name' => "Gatsby",
            ],
            [
                'code' => "REXONA",
                'name' => "Rexona",
            ],
            [
                'code' => "RDHRSE",
                'name' => "Red Horse",
            ],
            [
                'code' => "NSPRNG",
                'name' => "Nature's Spring",
            ],
            [
                'code' => "NOVA",
                'name' => "Nova",
            ],
            [
                'code' => "PIATOS",
                'name' => "Piattos",
            ],
            [
                'code' => "DLMNTE",
                'name' => "Del Monte",
            ],
            [
                'code' => "ZSTO",
                'name' => "Zest-o",
            ],
            [
                'code' => "MCHPS",
                'name' => "Mr. Chips",
            ],
            [
                'code' => "ZONROX",
                'name' => "Zonrox",
            ],
            [
                'code' => "PMOLVE",
                'name' => "Palmolive",
            ],
            [
                'code' => "SLVSWN",
                'name' => "Silver Swan",
            ],
            [
                'code' => "FDGBAR",
                'name' => "Fudgee Bar",
            ],
            [
                'code' => "C2TEA",
                'name' => "C2",
            ],
            [
                'code' => "LPVTN",
                'name' => "Lipovitan",
            ],
            [
                'code' => "SMART",
                'name' => "Smart",
            ],
            [
                'code' => "KWIK",
                'name' => "Kwik",
            ],
            [
                'code' => "MASITA",
                'name' => "Mama Sita",
            ],
            [
                'code' => "UFC",
                'name' => "UFC",
            ],
            [
                'code' => "FRNDZ",
                'name' => "Friendz",
            ],
        ];
    }
}
