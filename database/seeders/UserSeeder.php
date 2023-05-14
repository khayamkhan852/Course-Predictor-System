<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123')
        ]);

        $admin->assignRole('Super Admin');

        $teacher = User::create([
            'name' => 'khayam khan',
            'email' => 'khayamkhan852@gmail.com',
            'department_id' => 1,
            'password' => Hash::make('admin123')
        ]);

        $teacher->assignRole('Teacher');

        $student = User::create([
            'name' => 'Mazhar Ali',
            'email' => 'mazhar@gmail.com',
            'department_id' => 1,
            'password' => Hash::make('admin123')
        ]);

        $student->assignRole('Student');

        $hod = User::create([
            'name' => 'Asad Zaman',
            'email' => 'asad@gmail.com',
            'department_id' => 1,
            'password' => Hash::make('admin123')
        ]);

        $hod->assignRole('Head Of Department');

        $hod = User::create([
            'name' => 'Usama Khan',
            'email' => 'usama@gmail.com',
            'department_id' => 1,
            'password' => Hash::make('admin123')
        ]);

        $hod->assignRole('Head Of Department');

    }
}
