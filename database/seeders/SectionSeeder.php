<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::create([
            'name' => 'Section A'
        ]);

        Section::create([
            'name' => 'Section B'
        ]);

        Section::create([
            'name' => 'Section C'
        ]);
    }
}
