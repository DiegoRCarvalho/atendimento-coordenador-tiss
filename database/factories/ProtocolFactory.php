<?php

use act\Attendance;
use act\Protocol;
use act\ServiceProvider;
use Faker\Generator as Faker;

$factory->define(Protocol::class, function (Faker $faker) {
    return [
        'protocol' => $faker->unique()->numberBetween($min = 1000, $max = 9999),
        'service_provider_fk' =>$faker->randomElement(ServiceProvider::all()->pluck('id')->toArray()),
        'attendance_fk' =>$faker->randomElement(Attendance::all()->pluck('id')->toArray())
    ];
});
