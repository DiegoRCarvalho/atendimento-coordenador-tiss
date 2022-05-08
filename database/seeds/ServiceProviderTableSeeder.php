<?php

use act\ServiceProvider;
use Illuminate\Database\Seeder;

class ServiceProviderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(ServiceProvider::class, 10)->create();
    }
}
