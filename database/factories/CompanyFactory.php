<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'email' => $faker->email,
        'logo' => $faker->image(),
        'website' => $faker->url,
        'created_at' => $faker->dateTime($max = 'now'),
        'updated_at' => $faker->dateTime($max = 'now'),
    ];
});
