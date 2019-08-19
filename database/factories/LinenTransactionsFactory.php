<?php

use Faker\Generator as Faker;
$factory->define(App\Models\Inventory\Linen\LinenTransaction::class, function (Faker $faker) {
    return [
    	'slug' => $faker->randomElement([
				'blanket',
				'bedsheet',
				'towel',
				'pillow',
				'pillow-case'
	    	]),
    	'description' => $faker->words,
    ];
});
