<?php

use act\Protocol;
use Illuminate\Database\Seeder;

class ProtocolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Protocol::class, 30)->create();
    }
}
