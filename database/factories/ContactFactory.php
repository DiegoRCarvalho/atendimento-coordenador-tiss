<?php

use act\Contact;
use Faker\Generator as Faker;

$factory->define(Contact::class, function (Faker $faker) {

    return [
        'contact_name' => $faker->name(),
        'ddd' => $faker->numberBetween($min = 11, $max = 86),
        'telephone' => $faker->numberBetween($min = 22222222, $max = 999999999),
        'telephone_extension' => $faker->numberBetween($min = 222, $max = 9999),
        'email' => $faker->email(),
        'sector' => $faker->name(),
    ];
});
