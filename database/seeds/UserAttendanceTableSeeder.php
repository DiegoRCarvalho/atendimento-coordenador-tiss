<?php

use Illuminate\Database\Seeder;
use act\UserAttendance;

class UserAttendanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(UserAttendance::class, 10)->create();
    }
}
