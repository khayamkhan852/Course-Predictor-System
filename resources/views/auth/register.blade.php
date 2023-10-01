@extends('auth.Layouts.app')
@section('title', 'Register')
@section('content')
    <form class="form w-100" action="{{ route('register.store') }}" method="POST">
        @csrf
        <div class="text-center mb-8">
            <h1 class="text-dark fw-bolder mb-3">Sign Up</h1>
        </div>
        <div class="fv-row mb-8">
            <input type="text" class="form-control bg-transparent" id="name" value="{{ old('name') }}" placeholder="Name" name="name" autocomplete="off" autofocus  />
            @error('name')
                <x-error>{{ $message }}</x-error>
            @enderror
        </div>
        <div class="fv-row mb-8">
            <input type="email" class="form-control @error('name') is-invalid @enderror bg-transparent" id="email" value="{{ old('email') }}" placeholder="Email" name="email" autocomplete="off" />
            @if ($errors -> has('email'))
                <x-error>{{ $message }}</x-error>
            @endif
        </div>
        <div class="fv-row mb-8">
            <x-select-two name="department_id" id="department_id" message="Select Your Department">
                <option value=""></option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ old('department_id')== $department->id ? 'selected' : ''}}>{{ $department->name }}</option>
                @endforeach
            </x-select-two>
            @error('department_id')
                <x-error>{{ $message }}</x-error>
            @enderror
        </div>
        <div class="fv-row mb-8" data-kt-password-meter="true">
            <div class="mb-1">
                <div class="position-relative mb-3">
                    <input type="password"
                           class="form-control @error('password') is-invalid @enderror bg-transparent"
                           placeholder="Password" name="password" autocomplete="off" />
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
        <div class="fv-row mb-8">
            <input type="text" id="reg_number" class="form-control bg-transparent"
                   placeholder="Registration Number" name="reg_number" autocomplete="off" />
            @error('reg_number')
                <x-error>{{ $message }}</x-error>
            @enderror
        </div>
        <div class="d-grid mb-10">
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Sign up</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">Already have an Account?
            <a href="{{ route('login') }}" class="link-primary fw-semibold">Sign in</a>
        </div>
    </form>
@endsection
