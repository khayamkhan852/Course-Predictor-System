@extends('layouts.app')
@section('title', 'users')

@section('content')
    <x-breadcrum name="users" parent="1" parent-name="Settings" page-name="Reset Password" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15" style="background-color:#F5F6FA;">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('settings.users.post.reset-password', [$user]) }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="current_password" class="required">Current Password</x-label>
                                    <x-input type="password" id="current_password" name="current_password"
                                             value="{{ old('current_password') }}" placeholder="Current Password" autofocus required />
                                    @error('current_password')
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
                                                <x-input id="password" type="password" name="password" required
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

                            <x-button class="btn-primary">Reset Password</x-button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





