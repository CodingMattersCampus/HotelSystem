<?php

declare(strict_types = 1);

use Illuminate\Database\Seeder;
use App\Models\Inventory\Product;
use App\Models\Inventory\Brand;

final class ProductsTableSeeder extends Seeder
{
    public function run() : void
    {
        foreach ($this->delmonte() as $item) {
            $this->createProduct($item);
        }

        foreach ($this->zesto() as $item) {
            $this->createProduct($item);
        }

        foreach ($this->c2() as $item) {
            $this->createProduct($item);
        }

        foreach ($this->water() as $item) {
            $this->createProduct($item);
        }

        foreach ($this->meals() as $item) {
            $this->createProduct($item);
        }

        foreach ($this->cocacola() as $item) {
            $this->createProduct($item);
        }

        foreach ($this->luckyMe() as $item) {
            $this->createProduct($item);
        }

        foreach ($this->sanmiguel() as $item) {
            $this->createProduct($item);
        }
    }

    private function sanmiguel() : array
    {
        $name = "San Miguel";
        $brand = Brand::whereName($name)->first();

        return [
            [
                'sku'           => $brand->code . "PILSEN330ML",
                'name'          => "PILSEN 330ml",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0.57,
                'cost'          => 38.33,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "PILSEN330ML-24_case",
                'name'          => "PILSEN 330ml (24pcs/case)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 920,
                'set_quantity'  => 24,
                'set_type'      => 'case',
                'set_sku'       => $brand->code . "PILSEN330ML"
            ],
            [
                'sku'           => $brand->code . "PILSENLIGHT330ML",
                'name'          => "PILSEN LIGHT 330ml",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0.57,
                'cost'          => 38.33,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "PILSENLIGHT330ML-24_case",
                'name'          => "PILSEN LIGHT 330ml (24pcs/case)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 920,
                'set_quantity'  => 24,
                'set_type'      => 'case',
                'set_sku'       => $brand->code . "PILSENLIGHT330ML"
            ],
        ];
    }

    private function delmonte() : array
    {
        $name = "Del Monte";
        $brand = Brand::whereName($name)->first();

        return [
            [
                'sku'           => $brand->code . "PINEAPPLE240ML",
                'name'          => "Pineapple 240ml",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0.70,
                'cost'          => 23.54,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "PINEAPPLE240ML-24_box",
                'name'          => "Pineapple 240ml (24pcs/box)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 565,
                'set_quantity'  => 24,
                'set_type'      => 'box',
                'set_sku'       => $brand->code . "PINEAPPLE240ML"
            ],
        ];
    }

    private function zesto() : array
    {
        $name = "Zest-o";
        $brand = Brand::whereName($name)->first();

        return [
            [
                'sku'           => $brand->code . "MANGO250ML",
                'name'          => "Mango 250ml",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0.71,
                'cost'          => 23.43,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "MANGO250ML-30_box",
                'name'          => "Pineapple 240ml (30pcs/box)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 703,
                'set_quantity'  => 30,
                'set_type'      => 'box',
                'set_sku'       => $brand->code . "MANGO250ML"
            ],
        ];
    }

    private function c2() : array
    {
        $name = "C2";
        $brand = Brand::whereName($name)->first();

        return [
            [
                'sku'           => $brand->code . "APPLE355ML",
                'name'          => "C2 Apple 355ml",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0.63,
                'cost'          => 18.42,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "APPLE355ML-24_box",
                'name'          => "C2 Apple 355ml (24pcs/box)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 442,
                'set_quantity'  => 24,
                'set_type'      => 'box',
                'set_sku'       => $brand->code . "APPLE355ML"
            ],
        ];
    }

    private function water() : array
    {
        $name = "Nature's Spring";
        $brand = Brand::whereName($name)->first();

        return [
            [
                'sku'           => $brand->code . "Water1L",
                'name'          => "Water 1 Liter",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 2.01,
                'cost'          => 13.31,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "Water1L-20_box",
                'name'          => "Water 1 Liter (20pcs/box)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 266.20,
                'set_quantity'  => 20,
                'set_type'      => 'box',
                'set_sku'       => $brand->code . "Water1L"
            ],
            [
                'sku'           => $brand->code . "Water350ML",
                'name'          => "Water 350ml",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 1.89,
                'cost'          => 6.92,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "Water350ML-24_box",
                'name'          => "Water 350ml (24pcs/box)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 166.08,
                'set_quantity'  => 24,
                'set_type'      => 'box',
                'set_sku'       => $brand->code . "Water350ML"
            ],
        ];
    }

    private function meals() : array
    {
        $name = "Friendz";
        $brand = Brand::whereName($name)->first();

        return [
            [
                'sku'   => "2PCCHCKMEAL",
                'name'  => "2pcs Chicken Meal",
                'brand_id' => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 150.00,
                'for'           => 'store',
            ],
            [
                'sku'   => "CORNEDBEEFMEAL",
                'name'  => "Corned Beef Meal",
                'brand_id' => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 100.00,
                'for'           => 'store',
            ],
            [
                'sku'   => "BEEFSTEAKMEAL",
                'name'  => "Beef Steak Meal",
                'brand_id' => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 150.00,
                'for'           => 'store',
            ],
            [
                'sku'   => "BANGUSEGGMEAL",
                'name'  => "Bangus w/ Egg Meal",
                'brand_id' => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 150.00,
                'for'           => 'store',
            ],
            [
                'sku'   => "HOTDOGEGGMEAL",
                'name'  => "Hotdog w/ Egg Meal",
                'brand_id' => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 100.00,
                'for'           => 'store',
            ],
        ];  
    }

    private function cocacola() : array
    {
        $name = "Coca Cola";
        $brand = Brand::whereName($name)->first();

        return [
            [
                'sku'           => $brand->code . "COKEREG300ML",
                'name'          => "Coke Regular 300ml",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0.74,
                'cost'          => 23.00,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "COKEREG300ML-24_pack",
                'name'          => "Coke Regular 300ml (24pcs/pack)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 552.00,
                'set_quantity'  => 24,
                'set_type'      => 'pack',
                'set_sku'       => $brand->code . "COKEREG300ML"
            ],
            [
                'sku'           => $brand->code . "SPRTE300ML",
                'name'          => "Sprite 300ml",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0.74,
                'cost'          => 23.00,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "SPRTE300ML-24_pack",
                'name'          => "Sprite 300ml (24pcs/pack)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 552.00,
                'set_quantity'  => 24,
                'set_type'      => 'pack',
                'set_sku'       => $brand->code . "SPRTE300ML"
            ],
            [
                'sku'           => $brand->code . "ROYAL300ml",
                'name'          => "Royal 300ml",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 0.74,
                'cost'          => 23.00,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "ROYAL300ML-24_pack",
                'name'          => "Royal 300ml (24pcs/pack)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 552.00,
                'set_quantity'  => 24,
                'set_type'      => 'pack',
                'set_sku'       => $brand->code . "ROYAL300ML"
            ],
        ];
    }

    private function luckyMe() : array
    {
        $name = 'Lucky Me';
        $brand = Brand::whereName($name)->first();

        return [
            [
                'sku'           => $brand->code . "BEEF40G",
                'name'          => "Beef 40g",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 2.56,
                'cost'          => 15.45,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "BEEF40G-45_BOX",
                'name'          => "Beef 40g (45pcs/box)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 695.25,
                'set_quantity'  => 45,
                'set_type'      => 'box',
                'set_sku'       => $brand->code . "BEEF40G"
            ],
            [
                'sku'           => $brand->code . "PNOYCHKN40G",
                'name'          => "Pinoy Chicken 40g",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 2.56,
                'cost'          => 15.45,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "PNOYCHKN40G-45_BOX",
                'name'          => "Pinoy Chicken 40g (45pcs/box)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 695.25,
                'set_quantity'  => 45,
                'set_type'      => 'box',
                'set_sku'       => $brand->code . "PNOYCHKN40G"
            ],
            [
                'sku'           => $brand->code . "BULALO40G",
                'name'          => "Bulalo 40g",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 2.56,
                'cost'          => 15.45,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "BULALO40G-45_BOX",
                'name'          => "Bulalo 40g (45pcs/box)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 695.25,
                'set_quantity'  => 45,
                'set_type'      => 'box',
                'set_sku'       => $brand->code . "BULALO40G"
            ],
            [
                'sku'           => $brand->code . "STNGHON30G",
                'name'          => "Sotanghon 30g",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 2.05,
                'cost'          => 21.32,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "STNGHON30G-45_BOX",
                'name'          => "Sotanghon 30g (45pcs/box)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 695.25,
                'set_quantity'  => 45,
                'set_type'      => 'box',
                'set_sku'       => $brand->code . "STNGHON30G"
            ],
            [
                'sku'           => $brand->code . "JJMPONG30G",
                'name'          => "Jjamppong 30g",
                'brand_id'      => $brand->id,
                'orderable'     => true,
                'consumable'    => true,
                'profit_margin' => 2.31,
                'cost'          => 19.65,
                'for'           => 'store',
            ],
            [
                'sku'           => $brand->code . "JJMPONG30G-45_BOX",
                'name'          => "Jjamppong 30g (45pcs/box)",
                'brand_id'      => $brand->id,
                'orderable'     => false,
                'consumable'    => true,
                'profit_margin' => 0,
                'cost'          => 695.25,
                'set_quantity'  => 45,
                'set_type'      => 'box',
                'set_sku'       => $brand->code . "JJMPONG30G"
            ],
        ];
    }

    private function createProduct($item) : void
    {
        $item['sku'] = strtoupper($item['sku']);
        if (!Product::whereSku($item['sku'])->first()) {
            $item['min_threshold'] = random_int(10, 20);
            $item['max_threshold'] = random_int(1, 5);
            $item['stocks'] = random_int(5, 50);
            $item['price'] = floor($item['cost'] + ($item['cost'] * $item['profit_margin']));
            $product = Product::firstOrCreate($item);

            Product\ProductTransaction::firstOrCreate([
                'sku'           => $product->sku,
                'description'   => "Initial inventory",
                'user'          => \App\Models\User\User::first()->code,
                'in'            => $product->stocks ?? 0,
                'remaining'     => $product->stocks ?? 0,
                'cost'          => $product->cost ?? 0.00,
                'price'         => $product->price ?? 0.00,
            ]);
        }
    }
}
