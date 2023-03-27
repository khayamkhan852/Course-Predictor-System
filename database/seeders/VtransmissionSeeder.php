<?php

namespace Database\Seeders;

use App\Models\Vtransmission;
use Illuminate\Database\Seeder;

class VtransmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vtransmission::create([
            'v_transmission' => 'Automatic Transmission',
            'user_id' => 1,
        ]);

        Vtransmission::create([
            'v_transmission' => 'Torque Converter Transmission',
            'user_id' => 1,
        ]);
        Vtransmission::create([
            'v_transmission' => 'Continuously Variable Transmission',
            'user_id' => 1,
        ]);
        Vtransmission::create([
            'v_transmission' => 'Semi-Automatic Transmission',
            'user_id' => 1,
        ]);
        Vtransmission::create([
            'v_transmission' => 'Dual-Clutch Transmission',
            'user_id' => 1,
        ]);

        Vtransmission::create([
            'v_transmission' => 'Tiptronic Transmission',
            'user_id' => 1,
        ]);

        Vtransmission::create([
            'v_transmission' => 'Tiptronic Transmission',
            'user_id' => 1,
        ]);

        Vtransmission::create([
            'v_transmission' => 'Manual transmission',
            'user_id' => 1,
        ]);
    }
}
