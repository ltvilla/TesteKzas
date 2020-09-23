<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Address::class, function (Faker $faker) {
    return [
        'street' => $faker->streetName,
        'number' => $faker->numberBetween(1, 15000),
        'neighborhood' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'zipcode' => $faker->postcode,
        'employee_id' => function(){
            return factory(\App\Employee::class)->create()->id;
        },
        'created_at' => $faker->dateTime($max = 'now'),
        'updated_at' => $faker->dateTime($max = 'now'),
    ];
});
