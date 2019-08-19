<?php

use Faker\Generator as Faker;
use App\Models\Cash\Remittance;
use App\Models\Cash\Drawer;
use App\Models\User\Employee;
use Carbon\Carbon;

$factory->define(Drawer::class,function(Faker $faker) {
	$checkinAndOut = $faker->dateTimeThisYear(Carbon::now('Asia/Manila'));
	return [
		"code" 			=> $faker->uuid,
		"balance" 		=> $faker->randomFloat(2, $min = 5000, $max = 5000),
		"start_shift" 	=> $checkinAndOut,
		"end_shift" 	=> $checkinAndOut,
		"remitted" 		=> array_random([true, false]),
		"logged_out" 	=> array_random([true, false]),
	];
});

$factory->define(Remittance::class, function (Faker $faker) {
	$checkinAndOut = $faker->dateTimeThisYear(Carbon::now('Asia/Manila'));

    return [
		"code" 			=> $faker->uuid,
		"amount" 		=> $faker->randomFloat(2, $min = 3000, $max = 5000),
		"remitted" 		=> $faker->randomFloat(2, $min, $max),
		"created_at" 	=> $faker->dateTimeBetween('-1 month', '+12 months'),
    ];
});
