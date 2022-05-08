<?php

use Illuminate\Database\Seeder;

class ServiceProviderTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('service_provider_types')->insert([
            ['id' => '1' , 'description' => 'Clínica Especializada'],
            ['id' => '2' , 'description' => 'Consultório'],
            ['id' => '3' , 'description' => 'Consultório Odontológico'],
            ['id' => '4' , 'description' => 'Hospital'],
            ['id' => '5' , 'description' => 'Laboratório'],
            ['id' => '6' , 'description' => 'Serviço Especializado'],
        ]);
    }
}
