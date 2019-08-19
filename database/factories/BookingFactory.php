<?php

use Faker\Generator as Faker;
use App\Models\Booking\Booking;
use App\Models\Room\Room;
use App\Models\User\Employee;
use App\Models\Taxi\Taxi;
use Carbon\Carbon;
// This is for mock booking records only, reference to payment and other financial records do not apply.

$factory->define(Booking::class, function (Faker $faker) {
	$checkinAndOut = $faker->dateTimeThisYear(Carbon::now('Asia/Manila'));
	$user = Employee::all()->random()->code;
	$room = Room::all()->random();

    return [
        'room'          		=> $room->code,
        'code'          		=> $faker->uuid,
        'checkin'       		=> $checkinAndOut,
        'checkout'				=> $checkinAndOut,
        'timeout'       		=> $checkinAndOut, //default
        'checkin_by'    		=> $user,
        'checkout_by'			=> $user,
        'has_checked_out'		=> true,
        'rate'          		=> $faker->randomFloat(2, 250, 1000),
        'orders'				=> $faker->randomFloat(2, 0, 250),
        'penalties'				=> $faker->randomFloat(2, 0, 250),
        'taxi_referral_fee'		=> Taxi::REFERRAL_FEE,
        'created_at'			=> $checkinAndOut
    ];
});
