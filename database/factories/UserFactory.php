<?php

use act\User;
use act\Department;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'registration' => $faker->unique()->ean8(), //Nº de 8 dígitos
        'first_name' => $faker->firstName(),
        'last_name' => $faker->lastName(),
        'password' => bcrypt('123456'),
        'level' => $faker->randomElement( [1 , 2] ),
        'remember_token' => Str::random(10),
        'department_fk' => $faker->randomElement(Department::all()->pluck('id')->toArray()),
    ];
});
