<?php

use Faker\Generator as Faker;
use App\Models\Inventory\Brand;

$factory->define(Brand::class, function (Faker $faker) {
    $name = $faker->name;
    return [
        'code' => str_slug(str_shuffle($name), ''),
        'name' => $name,
        'slug' => str_slug($name)
    ];
});
