<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'CPF' => random_int(0, 15000),
        'company_id' => function(){
            return factory(\App\Company::class)->create()->id;
        },
        'created_at' => $faker->dateTime($max = 'now'),
        'updated_at' => $faker->dateTime($max = 'now'),
        'phone' => $faker->phoneNumber
    ];
});
