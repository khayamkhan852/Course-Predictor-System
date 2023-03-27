<?php

namespace Database\Seeders;

use App\Models\Vgroup;
use Illuminate\Database\Seeder;

class VgroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vgroup::create([
            'group_name' => 'Automatic',
            'user_id' => 1,
        ]);

        Vgroup::create([
            'group_name' => 'Manual',
            'user_id' => 1,
        ]);
    }
}
