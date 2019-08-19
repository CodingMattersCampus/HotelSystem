<?php

use Faker\Generator as Faker;
use App\Models\Taxi\Taxi;
use App\Models\Taxi\TaxiBooking;


$factory->define(Taxi::class, function (Faker $faker) {
    return [
		"plate" => $faker->word,
		"driver" => $faker->word,
		"make" => $faker->word,
		"model" => $faker->word,
		"color" => $faker->word,
    ];
});

$factory->define(TaxiBooking::class, function (Faker $faker) {
	return [
		'code' => $faker->uuid,
		// 'booking' => $faker->, //on seeder please
		// 'taxi' => $faker->, //seeder sad
		// 'referral_fee' => $faker->,
	];
});