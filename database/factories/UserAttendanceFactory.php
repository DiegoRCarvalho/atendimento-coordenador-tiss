<?php

use act\User;
use act\Attendance;
use act\ErrorDetail;
use act\SolutionDetail;
use Faker\Generator as Faker;

$factory->define(act\UserAttendance::class, function (Faker $faker) {
    return [
        'user' => $faker->randomElement(User::all()->pluck('id')->toArray()),
        'error_detail_fk' => $faker->randomElement(ErrorDetail::all()->pluck('id')->toArray()),
        'solution_detail_fk' => $faker->randomElement(SolutionDetail::all()->pluck('id')->toArray()),
        'note' => $faker->paragraph($nbSentences = 3),
        'attendance' => $faker->randomElement(Attendance::all()->pluck('id')->toArray()),
    ];
});
