@extends('admin.layouts.app')
@section('title', 'edit role')

@section('content')
    <x-breadcrum name="User Types" parent="1" parent-name="Settings" page-name="Edit User Type" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('admin.settings.roles.update', [$role->id]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="fv-row mb-5">
                                <x-label for="role_name" class="required">Role Name</x-label>
                                <x-input class="form-control-solid {{ $errors -> has('role_name') ? 'is-invalid' : '' }}"
                                         id="role_name" name="role_name" value="{{old('role_name') ?: $role->name }}" placeholder="Role Name" autofocus required />
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="user.view" is-checked="{{ in_array('user.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="user.create" is-checked="{{ in_array('user.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="user.update" is-checked="{{ in_array('user.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="user.delete" is-checked="{{ in_array('user.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="user.reset.password" is-checked="{{ in_array('user.reset.password', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="roles.create" is-checked="{{ in_array('roles.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="roles.update" is-checked="{{ in_array('roles.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="roles.delete" is-checked="{{ in_array('roles.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="partner.view" is-checked="{{ in_array('partner.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="partner.create" is-checked="{{ in_array('partner.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="partner.update" is-checked="{{ in_array('partner.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="partner.delete" is-checked="{{ in_array('partner.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="branch.view" is-checked="{{ in_array('branch.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="branch.create" is-checked="{{ in_array('branch.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="branch.update" is-checked="{{ in_array('branch.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="branch.delete" is-checked="{{ in_array('branch.delete', $permissions, false) }}">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="branch.print" is-checked="{{ in_array('branch.print', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="rent_type.view" is-checked="{{ in_array('rent_type.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="rent_type.create" is-checked="{{ in_array('rent_type.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="rent_type.update" is-checked="{{ in_array('rent_type.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="rent_type.delete" is-checked="{{ in_array('rent_type.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_type.view" is-checked="{{ in_array('vehicle_type.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_type.create" is-checked="{{ in_array('vehicle_type.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_type.update" is-checked="{{ in_array('vehicle_type.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_type.delete" is-checked="{{ in_array('vehicle_type.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_status.view" is-checked="{{ in_array('vehicle_status.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_status.create" is-checked="{{ in_array('vehicle_status.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_status.update" is-checked="{{ in_array('vehicle_status.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_status.delete" is-checked="{{ in_array('vehicle_status.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_group.view" is-checked="{{ in_array('vehicle_group.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_group.create" is-checked="{{ in_array('vehicle_group.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_group.update" is-checked="{{ in_array('vehicle_group.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_group.delete" is-checked="{{ in_array('vehicle_group.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_transmission.view" is-checked="{{ in_array('vehicle_transmission.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_transmission.create" is-checked="{{ in_array('vehicle_transmission.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_transmission.update" is-checked="{{ in_array('vehicle_transmission.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_transmission.delete" is-checked="{{ in_array('vehicle_transmission.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_fuel_type.view" is-checked="{{ in_array('vehicle_fuel_type.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_fuel_type.create" is-checked="{{ in_array('vehicle_fuel_type.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_fuel_type.update" is-checked="{{ in_array('vehicle_fuel_type.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_fuel_type.delete" is-checked="{{ in_array('vehicle_fuel_type.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_body_type.view" is-checked="{{ in_array('vehicle_body_type.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_body_type.create" is-checked="{{ in_array('vehicle_body_type.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_body_type.update" is-checked="{{ in_array('vehicle_body_type.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_body_type.delete" is-checked="{{ in_array('vehicle_body_type.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_drive.view" is-checked="{{ in_array('vehicle_drive.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_drive.create" is-checked="{{ in_array('vehicle_drive.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_drive.update" is-checked="{{ in_array('vehicle_drive.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="vehicle_drive.delete" is-checked="{{ in_array('vehicle_drive.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="business_setting.view" is-checked="{{ in_array('business_setting.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="business_setting.create" is-checked="{{ in_array('business_setting.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="business_setting.update" is-checked="{{ in_array('business_setting.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="business_setting.delete" is-checked="{{ in_array('business_setting.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px reports_all" name="permissions[]" value="booking_report.view" is-checked="{{ in_array('booking_report.view', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px reports_all" name="permissions[]" value="reservation_report.view" is-checked="{{ in_array('reservation_report.view', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px reports_all" name="permissions[]" value="payment_report.view" is-checked="{{ in_array('payment_report.view', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px reports_all" name="permissions[]" value="vehicle_earning_report.view" is-checked="{{ in_array('vehicle_earning_report.view', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="employees.view" is-checked="{{ in_array('employees.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="employees.create" is-checked="{{ in_array('employees.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="employees.update" is-checked="{{ in_array('employees.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="employees.delete" is-checked="{{ in_array('employees.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkin.view" is-checked="{{ in_array('checkin.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkin.create" is-checked="{{ in_array('checkin.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkin.update" is-checked="{{ in_array('checkin.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkin.delete" is-checked="{{ in_array('checkin.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkout.view" is-checked="{{ in_array('checkout.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkout.create" is-checked="{{ in_array('checkout.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkout.update" is-checked="{{ in_array('checkout.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="checkout.delete" is-checked="{{ in_array('checkout.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="salary_calculation.view" is-checked="{{ in_array('salary_calculation.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="salary_calculation.create" is-checked="{{ in_array('salary_calculation.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="salary_calculation.update" is-checked="{{ in_array('salary_calculation.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="salary_calculation.delete" is-checked="{{ in_array('salary_calculation.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="leave_request.view" is-checked="{{ in_array('leave_request.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="leave_request.create" is-checked="{{ in_array('leave_request.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="leave_request.update" is-checked="{{ in_array('leave_request.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px hr_all" name="permissions[]" value="leave_request.delete" is-checked="{{ in_array('leave_request.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.view" is-checked="{{ in_array('reservation.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.create" is-checked="{{ in_array('reservation.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.update" is-checked="{{ in_array('reservation.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.delete" is-checked="{{ in_array('reservation.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.excel" is-checked="{{ in_array('reservation.excel', $permissions, false) }}">
                                                                <span class="form-check-label">Excel</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.print" is-checked="{{ in_array('reservation.print', $permissions, false) }}">
                                                                <span class="form-check-label">Print</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.confirm" is-checked="{{ in_array('reservation.confirm', $permissions, false) }}">
                                                                <span class="form-check-label">Confirm</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="reservation.reject" is-checked="{{ in_array('reservation.reject', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="vehicle.view" is-checked="{{ in_array('vehicle.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="vehicle.create" is-checked="{{ in_array('vehicle.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="vehicle.update" is-checked="{{ in_array('vehicle.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="vehicle.delete" is-checked="{{ in_array('vehicle.delete', $permissions, false) }}">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="vehicle.delete" is-checked="{{ in_array('vehicle.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer.view" is-checked="{{ in_array('customer.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer.create" is-checked="{{ in_array('customer.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer.update" is-checked="{{ in_array('customer.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer.delete" is-checked="{{ in_array('customer.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_type.view" is-checked="{{ in_array('customer_type.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_type.create" is-checked="{{ in_array('customer_type.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_type.update" is-checked="{{ in_array('customer_type.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_type.delete" is-checked="{{ in_array('customer_type.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_status.view" is-checked="{{ in_array('customer_status.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_status.create" is-checked="{{ in_array('customer_status.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_status.update" is-checked="{{ in_array('customer_status.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="customer_status.delete" is-checked="{{ in_array('customer_status.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.view" is-checked="{{ in_array('challan.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.create" is-checked="{{ in_array('challan.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.update" is-checked="{{ in_array('challan.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.delete" is-checked="{{ in_array('challan.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.print" is-checked="{{ in_array('challan.print', $permissions, false) }}">
                                                                <span class="form-check-label">Print</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="challan.excel" is-checked="{{ in_array('challan.excel', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.view" is-checked="{{ in_array('blacklist.view', $permissions, false) }}">
                                                                <span class="form-check-label">View</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.create" is-checked="{{ in_array('blacklist.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.update" is-checked="{{ in_array('blacklist.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.delete" is-checked="{{ in_array('blacklist.delete', $permissions, false) }}">
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
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.print" is-checked="{{ in_array('blacklist.print', $permissions, false) }}">
                                                                <span class="form-check-label">Print</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px operations_all" name="permissions[]" value="blacklist.excel" is-checked="{{ in_array('blacklist.excel', $permissions, false) }}">
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
                            <x-button class="btn-primary">Update {{ $role->name }}</x-button>
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




