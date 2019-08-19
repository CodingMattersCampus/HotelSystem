<?php

use Faker\Generator as Faker;
use App\Models\Room\Room;
use App\Models\Room\RoomType;
use App\Models\Room\RoomStatus;
use App\Models\Room\RoomTransaction;

$factory->define(Room::class, function (Faker $faker) {
    return [
        'code'              => $faker->uuid,
        'name'              => $faker->buildingNumber,
        'type'              => array_rand(RoomType::getTypes()),
    ];
});

$factory->define(RoomTransaction::class, function (Faker $faker) {
	return [
        'code'       => $faker->uuid,
		'status' 	 => array_rand(RoomStatus::getStatuses()),
		'created_at' => $faker->dateTimeBetween('-1 month', '+12 months')
	];
});

