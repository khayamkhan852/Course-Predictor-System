@extends('layouts.app')
@section('title', 'edit role')

@section('content')
    <x-breadcrum name="User Types" parent="1" parent-name="Settings" page-name="Edit User Type" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('settings.roles.update', [$role->id]) }}" method="POST" enctype="multipart/form-data">
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
                                                <td class="text-gray-800">Departments</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px" name="permissions[]" value="departments.view" is-checked="{{ in_array('departments.view', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px" name="permissions[]" value="departments.create" is-checked="{{ in_array('departments.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px" name="permissions[]" value="departments.update" is-checked="{{ in_array('departments.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px" name="permissions[]" value="departments.delete" is-checked="{{ in_array('departments.delete', $permissions, false) }}">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="text-gray-800">Courses</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px" name="permissions[]" value="courses.view" is-checked="{{ in_array('courses.view', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px" name="permissions[]" value="courses.create" is-checked="{{ in_array('courses.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px" name="permissions[]" value="courses.update" is-checked="{{ in_array('courses.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px" name="permissions[]" value="courses.delete" is-checked="{{ in_array('courses.delete', $permissions, false) }}">
                                                                <span class="form-check-label">Delete</span>
                                                            </x-checkbox>
                                                        </label>
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
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="roles.view" is-checked="{{ in_array('roles.view', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
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
                                                <td class="text-gray-800">Sections</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="sections.view" is-checked="{{ in_array('sections.view', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="sections.create" is-checked="{{ in_array('sections.create', $permissions, false) }}">
                                                                <span class="form-check-label">Create</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="sections.update" is-checked="{{ in_array('sections.update', $permissions, false) }}">
                                                                <span class="form-check-label">Edit</span>
                                                            </x-checkbox>
                                                        </label>
                                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                                            <x-checkbox class="h-30px w-30px settings_all" name="permissions[]" value="sections.delete" is-checked="{{ in_array('sections.delete', $permissions, false) }}">
                                                                <span class="form-check-label">Delete</span>
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
                .not('#check_settings_all')
                .prop('checked', this.checked);
        });

        $("#check_settings_all").click(function(){
            $('.settings_all').prop('checked', this.checked);
        });
    </script>
@endsection




