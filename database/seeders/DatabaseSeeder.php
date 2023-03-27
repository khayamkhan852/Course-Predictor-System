<?php

namespace Database\Seeders;

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
        $this->call(PermissionSeeder::class);
        $this->call(BranchSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(FleverSeeder::class);
        $this->call(VgroupSeeder::class);
        $this->call(VtransmissionSeeder::class);
        $this->call(FuelTypeSeeder::class);
        $this->call(VehicleBodyTypeSeeder::class);
        $this->call(VehicleDriveSeeder::class);
    }
}
