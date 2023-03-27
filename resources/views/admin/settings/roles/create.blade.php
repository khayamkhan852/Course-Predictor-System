@extends('admin.layouts.app')
@section('title', 'new role')

@section('content')
    <x-breadcrum name="User Types" parent="1" parent-name="Settings" page-name="New User Type" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('admin.settings.roles.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="fv-row mb-5">
                                <x-label for="role_name" class="required">Role Name</x-label>
                                <x-input class="form-control-solid {{ $errors -> has('role_name') ? 'is-invalid' : '' }}"
                                         id="role_name" name="role_name" value="{{ old('role_name') }}" placeholder="Role Name" autofocus required />
                                @error('role_name')
                                    <x-error>{{ $message }}</x-error>
                                @enderror
                            </div>
                            <div class="fv-row">
                                <label class="fs-5 fw-bold form-label mb-2 mt-3">Role Permissions</label>
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-bordered fs-6 gy-5">
                                        <tbody class="text-gray-600 fw-semibold">
                                            <tr>
                                                <td class="text-success">Administrator Access
                                                    <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Allows a full access to the system"></i>
                                                </td>
                                                <td>
                                                    <div class="form-check form-check-custom form-check-success form-check-solid me-10">
                                                        <x-checkbox class="h-30px w-30px" id="checkAll">
                                                            <label class="text-success">Check all</label>
                                                        </x-checkbox>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> <label class="fs-5 fw-bold form-label mb-2 mt-3 text-primary">Settings</label></td>
                                                <td>
                                                    <div class="form-check form-check-custom form-check-primary form-check-solid me-10">
                                                        <x-checkbox class="h-30px w-30px" id="check_settings_all">
                                                            <label class="text-primary">Check all settings</label>
                                                        </x-checkbox>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Users</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="user.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="user.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="user.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="user.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Users</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="user.reset.password">
                                                                <span class="form-check-label">Reset Password</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Roles</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="roles.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="roles.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="roles.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Partners</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="partner.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="partner.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="partner.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="partner.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Branches</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="branch.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="branch.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="branch.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="branch.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="branch.print">
                                                                <span class="form-check-label">Print</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Rent Types</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="rent_type.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="rent_type.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="rent_type.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="rent_type.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Vehicle Types</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_type.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_type.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_type.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_type.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Vehicle Statuses</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_status.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_status.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_status.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_status.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Vehicle Groups</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_group.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_group.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_group.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_group.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Vehicle Transmissions</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_transmission.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_transmission.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_transmission.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_transmission.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Vehicle Fuel Types</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_fuel_type.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_fuel_type.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_fuel_type.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_fuel_type.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Vehicle Body Types</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_body_type.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_body_type.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_body_type.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_body_type.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Vehicle Drives</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_drive.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_drive.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_drive.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_drive.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Business settings</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="business_setting.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="business_setting.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="business_setting.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="business_setting.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>


                                            <tr>
                                                <td> <label class="fs-5 fw-bold form-label mb-2 mt-3 text-primary">Reports</label></td>
                                                <td>
                                                    <div class="form-check form-check-custom form-check-primary form-check-solid me-10">
                                                        <x-checkbox class="h-30px w-30px" id="check_reports_all">
                                                            <label class="text-primary">Check all Reports</label>
                                                        </x-checkbox>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Booking Report</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px reports_all" name="permissions[]" value="booking_report.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Reservation Report</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px reports_all" name="permissions[]" value="reservation_report.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Payment Report</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px reports_all" name="permissions[]" value="payment_report.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Vehicle Earning Report</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px reports_all" name="permissions[]" value="vehicle_earning_report.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> <label class="fs-5 fw-bold form-label mb-2 mt-3 text-primary">HR</label></td>
                                                <td>
                                                    <div class="form-check form-check-custom form-check-primary form-check-solid me-10">
                                                        <x-checkbox class="h-30px w-30px" id="check_hr_all">
                                                            <label class="text-primary">Check all HR</label>
                                                        </x-checkbox>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Employees</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="employees.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="employees.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="employees.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="employees.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Check in</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkin.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkin.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkin.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkin.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Check out</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkout.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkout.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkout.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkout.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Salary</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="salary_calculation.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="salary_calculation.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="salary_calculation.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="salary_calculation.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Leave Request</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="leave_request.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="leave_request.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="leave_request.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="leave_request.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> <label class="fs-5 fw-bold form-label mb-2 mt-3 text-primary">Operations</label></td>
                                                <td>
                                                    <div class="form-check form-check-custom form-check-primary form-check-solid me-10">
                                                        <x-checkbox class="h-30px w-30px" id="check_operations_all">
                                                            <label class="text-primary">Check all Operations</label>
                                                        </x-checkbox>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Reservations</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Reservations</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.excel">
                                                                <span class="form-check-label">Excel</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.print">
                                                                <span class="form-check-label">Print</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.confirm">
                                                                <span class="form-check-label">Confirm</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.reject">
                                                                <span class="form-check-label">Reject</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Vehicle</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="vehicle.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="vehicle.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="vehicle.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="vehicle.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="vehicle.delete">
                                                                <span class="form-check-label">Disable</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Customers</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Customer Types</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_type.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_type.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_type.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_type.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Customer Statuses</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_status.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_status.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_status.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_status.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Challans</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Challans</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.print">
                                                                <span class="form-check-label">Print</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.excel">
                                                                <span class="form-check-label">Excel</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Blacklists</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.view">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.create">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.update">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.delete">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Blacklists</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.print">
                                                                <span class="form-check-label">Print</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.excel">
                                                                <span class="form-check-label">Excel</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <x-button class="btn-primary">Save Role and Permissions</x-button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('javascript')
    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this)
                .not('#check_settings_all, #check_reports_all, #check_hr_all, #check_operations_all')
                .prop('checked', this.checked);
        });

        $("#check_settings_all").click(function(){
            $('.settings_all').prop('checked', this.checked);
        });

        $("#check_reports_all").click(function(){
            $('.reports_all').prop('checked', this.checked);
        });

        $("#check_hr_all").click(function(){
            $('.hr_all').prop('checked', this.checked);
        });

        $("#check_operations_all").click(function(){
            $('.operations_all').prop('checked', this.checked);
        });
    </script>
@endsection





