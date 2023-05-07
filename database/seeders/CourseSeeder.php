<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::create([
            'code' => 'CSC 1012',
            'title' => 'Object Oriented Programming',
            'credit_hours' => 3,
            'course_level' => 'BS',
            'department_id' => 1,
        ]);
    }
}
