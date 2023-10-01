<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            // users
            ['name' => 'user.view'],
            ['name' => 'user.create'],
            ['name' => 'user.update'],
            ['name' => 'user.delete'],
            ['name' => 'user.reset.password'],

            // users type
            ['name' => 'roles.view'],
            ['name' => 'roles.create'],
            ['name' => 'roles.update'],
            ['name' => 'roles.delete'],

            // users type
            ['name' => 'sections.view'],
            ['name' => 'sections.create'],
            ['name' => 'sections.update'],
            ['name' => 'sections.delete'],


            // departments
            ['name' => 'departments.view'],
            ['name' => 'departments.create'],
            ['name' => 'departments.update'],
            ['name' => 'departments.delete'],

            // courses
            ['name' => 'courses.view'],
            ['name' => 'courses.create'],
            ['name' => 'courses.update'],
            ['name' => 'courses.delete'],

            // semesters
            ['name' => 'semesters.view'],
            ['name' => 'semesters.create'],
            ['name' => 'semesters.update'],
            ['name' => 'semesters.delete'],
            ['name' => 'semesters.assign_courses'],

            // Course Registration
            ['name' => 'course_registration.view'],
            ['name' => 'course_registration.create'],
            ['name' => 'course_registration.update'],
            ['name' => 'course_registration.delete'],
        ];

        $insert_data = [];
        $time_stamp = Carbon::now()->toDateTimeString();

        foreach ($data as $d) {
            $d['guard_name'] = 'web';
            $d['created_at'] = $time_stamp;
            $d['updated_at'] = $time_stamp;
            $insert_data[] = $d;
        }

        Permission::insert($insert_data);

        $role = Role::create(['name' => 'Super Admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Student']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Teacher']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'Head Of Department']);
        $role->givePermissionTo(Permission::all());

    }
}
