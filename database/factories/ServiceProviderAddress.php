<?php

use act\Address;
use act\ServiceProvider;
use Faker\Generator as Faker;
use act\ServiceProviderAddress;

$factory->define(ServiceProviderAddress::class, function (Faker $faker) {
    return [
        'service_provider' => $faker->randomElement(ServiceProvider::all()->pluck('id')->toArray()),
        'address' => $faker->randomElement(Address::all()->pluck('id')->toArray()),
    ];
});
