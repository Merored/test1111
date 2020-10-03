<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;
use Illuminate\Support\Str;



$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'surname' => $faker->lastName,
        'country' => $faker->company,
        'phone' => $faker->phoneNumber, 
    ];
});