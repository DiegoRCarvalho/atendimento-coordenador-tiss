<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('departments')->insert([
            ['id' => '1' , 'description' => 'Administrativo'],
            ['id' => '2' , 'description' => 'Análise'],
            ['id' => '3' , 'description' => 'Autorizações'],
            ['id' => '4' , 'description' => 'Comercial'],
            ['id' => '5' , 'description' => 'Credenciamento'],
            ['id' => '6' , 'description' => 'Financeiro'],
            ['id' => '7' , 'description' => 'Jurídico'],
            ['id' => '8' , 'description' => 'Logística'],
            ['id' => '9' , 'description' => 'TI'],
            ['id' => '10' , 'description' => 'Atendimento'],
            ['id' => '11' , 'description' => 'Coordenador TISS'],
        ]);
    }
}
