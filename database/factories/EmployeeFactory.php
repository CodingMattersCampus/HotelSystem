<?php

use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use App\Models\User\EmployeeRole;

$factory->define(App\Models\User\Employee::class, function (Faker $faker) {
    return [
        'code'          => $faker->uuid,
        'username'      => $faker->userName,
        'password'      => Hash::make('secret'),
        'first_name'    => $faker->firstName,
        'middle_name'   => $faker->lastName,
        'last_name'     => $faker->lastName,
        'role'          => array_rand(EmployeeRole::getRoles()),
    ];
});
