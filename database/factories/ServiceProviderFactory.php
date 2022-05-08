<?php

use act\ServiceProvider;
use act\ServiceProviderType;
use Faker\Generator as Faker;

$factory->define(ServiceProvider::class, function (Faker $faker) {

    return [
        'cpf_cnpj' => $faker->numberBetween($min = 11111111, $max = 99999999999999),
        'corporate_name' => $faker->company(),
        'company_fancy_name' => $faker->company(),
        'type_fk' =>$faker->randomElement(ServiceProviderType::all()->pluck('id')->toArray())

    ];
});
