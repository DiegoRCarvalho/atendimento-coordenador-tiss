<?php

use act\Attendance;
use act\Contact;

use act\ServiceProvider;
use Faker\Generator as Faker;

$factory->define(Attendance::class, function (Faker $faker) {
    return [
        'contact_fk' => $faker->randomElement(Contact::all()->pluck('id')->toArray()),
        'service_provider_fk' =>$faker->randomElement(ServiceProvider::all()->pluck('id')->toArray()),
        'action' => $faker->numberBetween($min = 1, $max = 3),
    ];
});
