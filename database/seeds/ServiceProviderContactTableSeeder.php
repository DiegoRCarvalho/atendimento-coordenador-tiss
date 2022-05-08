<?php

use act\ServiceProviderContact;
use Illuminate\Database\Seeder;

class ServiceProviderContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ServiceProviderContact::class, 10)->create();
    }
}
