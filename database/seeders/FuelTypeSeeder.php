<?php

namespace Database\Seeders;

use App\Models\Fueltype;
use Illuminate\Database\Seeder;

class FuelTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Fueltype::create([
            'fuel_type' => 'Regular',
            'user_id' => 1,
        ]);
        Fueltype::create([
            'fuel_type' => 'Mid-grade',
            'user_id' => 1,
        ]);
        Fueltype::create([
            'fuel_type' => 'Premium',
            'user_id' => 1,
        ]);
        Fueltype::create([
            'fuel_type' => 'Flex-fuel',
            'user_id' => 1,
        ]);

        Fueltype::create([
            'fuel_type' => 'Diesel',
            'user_id' => 1,
        ]);

        Fueltype::create([
            'fuel_type' => 'Petrol',
            'user_id' => 1,
        ]);

        Fueltype::create([
            'fuel_type' => 'CNG',
            'user_id' => 1,
        ]);
    }
}
