<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(ErrorDetailTableSeeder::class);
        //$this->call(SolutionDetailTableSeeder::class);
        //$this->call(DepartmentTableSeeder::class);
        //$this->call(ServiceProviderTypeSeeder::class);
        //$this->call(UserTableSeeder::class);
        //$this->call(ServiceProviderTableSeeder::class);
        //$this->call(ContactTableSeeder::class);
        //$this->call(AddressTableSeeder::class);
        //$this->call(AttendanceTableSeeder::class);
        $this->call(UserAttendanceTableSeeder::class);
        $this->call(ProtocolTableSeeder::class);
        $this->call(ServiceProviderContactTableSeeder::class);
        $this->call(ServiceProviderAddressTableSeeder::class);
    }
}
