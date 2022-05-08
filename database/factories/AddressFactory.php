<?php

use act\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'address' => $faker->streetAddress(),
        'number' => $faker->randomNumber(4),
        'complement' => $faker->secondaryAddress(),
        'neighborhood' => $faker->streetName(),
        'city' => $faker->city(),
        'city' => $faker->state(),
        'uf' => $faker->stateAbbr(),
        'zipcode' => $faker->postcode(),
        'main_address' => '0',
    ];
});
