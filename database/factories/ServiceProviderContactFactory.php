<?php

use act\Contact;
use act\ServiceProvider;
use Faker\Generator as Faker;

$factory->define(act\ServiceProviderContact::class, function (Faker $faker) {
    return [
        'service_provider' => $faker->randomElement(ServiceProvider::all()->pluck('id')->toArray()),
        'contact' => $faker->randomElement(Contact::all()->pluck('id')->toArray())
    ];
});
