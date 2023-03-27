<?php

namespace Database\Seeders;

use App\Models\Flevel;
use Illuminate\Database\Seeder;

class FleverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Flevel::create([
            'level' => 0,
            'user_id' => 1
        ]);
        for ($i = 10; $i <= 100; $i += 10) {
            Flevel::create([
                'level' => $i,
                'user_id' => 1
            ]);
        }

    }
}
