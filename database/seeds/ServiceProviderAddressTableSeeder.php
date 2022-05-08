<?php

use act\ServiceProviderAddress;
use Illuminate\Database\Seeder;

class ServiceProviderAddressTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ServiceProviderAddress::class, 10)->create();
    }
}
