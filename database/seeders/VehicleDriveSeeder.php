<?php

namespace Database\Seeders;

use App\Models\Vdrive;
use Illuminate\Database\Seeder;

class VehicleDriveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vdrive::create([
            'vehicle_drive' => 'Front',
            'user_id' => 1,
        ]);
        Vdrive::create([
            'vehicle_drive' => 'Rear',
            'user_id' => 1,
        ]);
    }
}
