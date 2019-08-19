<?php

use Faker\Generator as Faker;
use App\Models\Inventory\Product;
use App\Models\Inventory\Brand;

$factory->define(Product::class, function (Faker $faker) {
    $margin = array_random([0.2, 0.5, 0.75, 1, 1.2, 1.5, 1.75, 2]);
    $cost = random_int(5, 50);
    $price = $cost + ($cost * $margin);
    return [
        'sku'           => str_random(16),
        'name'          => $faker->company,
        'brand_id'      => random_int(1, Brand::count()),
        'price'         => $price,
        'cost'          => $cost,
        'stocks'        => random_int(0, 100),
        'consumable'    => array_random([true, false]),
        'orderable'     => array_random([true, false]),
        'profit_margin' => $margin,
        'max_threshold' => random_int(1, 10),
        'min_threshold' => random_int(11, 20),
    ];
});
