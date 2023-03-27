@extends('layouts.app')
@section('title', 'new role')

@section('content')
    <x-breadcrum name="User Types" parent="1" parent-name="Settings" page-name="New User Type" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('settings.roles.store') }}" method="POST" enctype="multipart/form-data">
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
                .not('#check_settings_all')
                .prop('checked', this.checked);
        });

        $("#check_settings_all").click(function(){
            $('.settings_all').prop('checked', this.checked);
        });
    </script>
@endsection





