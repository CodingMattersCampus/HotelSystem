<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Penalty\Penalty::class, function (Faker $faker) {

    $name = $faker->word;

    return [
        'name' => $name,
        'slug' => str_slug($name),
        'rate' => random_int(100, 300),
    ];
});


$factory->define(App\Models\Booking\BookingPenalty::class, function (Faker $faker) {
	return [
		'code' => $faker->uuid(),
		'rate' => $faker->randomFloat( 2, 20, 100)
	];
});