<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            'name' => 'DEPARTMENT OF SOFTWARE ENGINEERING',
            'short_name' => 'BCSE',
        ]);

        Department::create([
            'name' => 'DEPARTMENT OF COMPUTER SCIENCE',
            'short_name' => 'BCSC',
        ]);
    }
}
