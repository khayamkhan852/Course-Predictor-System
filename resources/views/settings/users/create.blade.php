@extends('layouts.app')
@section('title', 'users')

@section('content')
    <x-breadcrum name="users" parent="1" parent-name="Settings" page-name="New User" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('settings.users.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-10">
                                <div class="col-12">
                                    <x-image-preloaded name="user_avatar" />
                                </div>
                            </div>
                            @error('user_avatar')
                                <x-error>{{ $message }}</x-error>
                            @enderror

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="name" class="required">Name</x-label>
                                    <x-input id="name" name="name" value="{{ old('name') }}"
                                             placeholder="Name" autofocus required />
                                    @error('name')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="email" class="required">Email</x-label>
                                    <x-input id="email" type="email" name="email"
                                             value="{{ old('email') }}" required placeholder="Email" />
                                    @error('email')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-10">
                                    <x-label for="role" class="required">User Role</x-label>
                                    <x-select-two name="role" id="role" required>
                                        <option value=""></option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" {{ old('role')== $role->id ? 'selected' : ''}}>{{ $role->name }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('role')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-6 mb-10">
                                    <x-label for="department_id" class="required">Department</x-label>
                                    <x-select-two name="department_id" id="department_id" required>
                                        <option value=""></option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{ old('department_id')== $department->id ? 'selected' : ''}}>{{ $department->name }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('department_id')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-10">
                                    <x-label for="reg_number">Registration Number</x-label>
                                    <x-input id="reg_number" type="text" name="reg_number" value="{{ old('reg_number') }}" placeholder="Registration Number" />
                                    @error('reg_number')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="password" class="required">Password</x-label>
                                    <div class="fv-row mb-8" data-kt-password-meter="true">
                                        <div class="mb-1">
                                            <div class="position-relative mb-3">
                                                <x-input id="password" type="password" name="password"
                                                         value="{{ old('password') }}" required
                                                         placeholder="Password" autocomplete="off" />
                                                @error('password')
                                                    <x-error>{{ $message }}</x-error>
                                                @enderror
                                                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                    <i class="bi bi-eye-slash fs-2"></i>
                                                    <i class="bi bi-eye fs-2 d-none"></i>
                                                </span>
                                            </div>
                                            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                            </div>
                                        </div>
                                        <div class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols.</div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="password_confirmation" class="required">Confirm Password</x-label>
                                    <x-input id="password_confirmation" type="password" name="password_confirmation"
                                             placeholder="Confirm Password" required autocomplete="off" />
                                </div>
                            </div>
                            <x-button class="btn-primary">Create New User</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





