<?php

namespace Database\Seeders;

use App\Models\Vbody;
use Illuminate\Database\Seeder;

class VehicleBodyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vbody::create([
            'body_type' => 'SEDAN',
            'user_id' => 1
        ]);

        Vbody::create([
            'body_type' => 'COUPE',
            'user_id' => 1
        ]);

        Vbody::create([
            'body_type' => 'SPORTS CAR',
            'user_id' => 1
        ]);

        Vbody::create([
            'body_type' => 'STATION WAGON',
            'user_id' => 1
        ]);

        Vbody::create([
            'body_type' => 'HATCHBACK',
            'user_id' => 1
        ]);

        Vbody::create([
            'body_type' => 'CONVERTIBLE',
            'user_id' => 1
        ]);

        Vbody::create([
            'body_type' => 'SPORT-UTILITY VEHICLE (SUV)',
            'user_id' => 1
        ]);

        Vbody::create([
            'body_type' => 'MINIVAN',
            'user_id' => 1
        ]);

        Vbody::create([
            'body_type' => 'PICKUP TRUCK',
            'user_id' => 1
        ]);
    }
}
