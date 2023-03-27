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
            ['name' => 'roles.create'],
            ['name' => 'roles.update'],
            ['name' => 'roles.delete'],

            // Partner
            ['name' => 'partner.view'],
            ['name' => 'partner.create'],
            ['name' => 'partner.update'],
            ['name' => 'partner.delete'],

            // Branches
            ['name' => 'branch.view'],
            ['name' => 'branch.create'],
            ['name' => 'branch.update'],
            ['name' => 'branch.delete'],
            ['name' => 'branch.print'],

            // Rent type
            ['name' => 'rent_type.view'],
            ['name' => 'rent_type.create'],
            ['name' => 'rent_type.update'],
            ['name' => 'rent_type.delete'],

            // Vehicle type
            ['name' => 'vehicle_type.view'],
            ['name' => 'vehicle_type.create'],
            ['name' => 'vehicle_type.update'],
            ['name' => 'vehicle_type.delete'],

            // Vehicle Statuses
            ['name' => 'vehicle_status.view'],
            ['name' => 'vehicle_status.create'],
            ['name' => 'vehicle_status.update'],
            ['name' => 'vehicle_status.delete'],

            // Vehicle Groups
            ['name' => 'vehicle_group.view'],
            ['name' => 'vehicle_group.create'],
            ['name' => 'vehicle_group.update'],
            ['name' => 'vehicle_group.delete'],

            // Vehicle Transmissions
            ['name' => 'vehicle_transmission.view'],
            ['name' => 'vehicle_transmission.create'],
            ['name' => 'vehicle_transmission.update'],
            ['name' => 'vehicle_transmission.delete'],

            // Vehicle Fuel Types
            ['name' => 'vehicle_fuel_type.view'],
            ['name' => 'vehicle_fuel_type.create'],
            ['name' => 'vehicle_fuel_type.update'],
            ['name' => 'vehicle_fuel_type.delete'],

            // Vehicle Body Types
            ['name' => 'vehicle_body_type.view'],
            ['name' => 'vehicle_body_type.create'],
            ['name' => 'vehicle_body_type.update'],
            ['name' => 'vehicle_body_type.delete'],

            // Vehicle Drive
            ['name' => 'vehicle_drive.view'],
            ['name' => 'vehicle_drive.create'],
            ['name' => 'vehicle_drive.update'],
            ['name' => 'vehicle_drive.delete'],

            // Business settings
            ['name' => 'business_setting.view'],
            ['name' => 'business_setting.create'],
            ['name' => 'business_setting.update'],
            ['name' => 'business_setting.delete'],

            //Reports
            ['name' => 'booking_report.view'],
            ['name' => 'reservation_report.view'],
            ['name' => 'payment_report.view'],
            ['name' => 'vehicle_earning_report.view'],

            // HR
            ['name' => 'employees.view'],
            ['name' => 'employees.create'],
            ['name' => 'employees.update'],
            ['name' => 'employees.delete'],

            ['name' => 'checkin.view'],
            ['name' => 'checkin.create'],
            ['name' => 'checkin.update'],
            ['name' => 'checkin.delete'],

            ['name' => 'checkout.view'],
            ['name' => 'checkout.create'],
            ['name' => 'checkout.update'],
            ['name' => 'checkout.delete'],

            ['name' => 'salary_calculation.view'],
            ['name' => 'salary_calculation.create'],
            ['name' => 'salary_calculation.update'],
            ['name' => 'salary_calculation.delete'],

            ['name' => 'leave_request.view'],
            ['name' => 'leave_request.create'],
            ['name' => 'leave_request.update'],
            ['name' => 'leave_request.delete'],

            // Operations
            ['name' => 'bookings.view'],
            ['name' => 'bookings.create'],
            ['name' => 'bookings.update'],
            ['name' => 'bookings.delete'],
            ['name' => 'bookings.print'],

            // Operations
            ['name' => 'reservation.view'],
            ['name' => 'reservation.create'],
            ['name' => 'reservation.update'],
            ['name' => 'reservation.delete'],
            ['name' => 'reservation.excel'],
            ['name' => 'reservation.print'],
            ['name' => 'reservation.confirm'],
            ['name' => 'reservation.reject'],


            ['name' => 'vehicle.view'],
            ['name' => 'vehicle.create'],
            ['name' => 'vehicle.update'],
            ['name' => 'vehicle.delete'],
            ['name' => 'vehicle.disable'],

            ['name' => 'customer.view'],
            ['name' => 'customer.create'],
            ['name' => 'customer.update'],
            ['name' => 'customer.delete'],

            ['name' => 'customer_type.view'],
            ['name' => 'customer_type.create'],
            ['name' => 'customer_type.update'],
            ['name' => 'customer_type.delete'],

            ['name' => 'customer_status.view'],
            ['name' => 'customer_status.create'],
            ['name' => 'customer_status.update'],
            ['name' => 'customer_status.delete'],

            ['name' => 'challan.view'],
            ['name' => 'challan.create'],
            ['name' => 'challan.update'],
            ['name' => 'challan.delete'],
            ['name' => 'challan.print'],
            ['name' => 'challan.excel'],

            ['name' => 'blacklist.view'],
            ['name' => 'blacklist.create'],
            ['name' => 'blacklist.update'],
            ['name' => 'blacklist.delete'],
            ['name' => 'blacklist.print'],
            ['name' => 'blacklist.excel'],


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

        $role = Role::create(['name' => 'Admin']);
        $role->givePermissionTo(Permission::all());

    }
}
