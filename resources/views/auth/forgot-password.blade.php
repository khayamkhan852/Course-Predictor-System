@extends('auth.Layouts.app')
@section('title', 'Forgot Password')
@section('content')
    <form class="form w-100" method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="text-center mb-10">
            <h1 class="text-dark fw-bolder mb-3">Forgot Password ?</h1>
            <div class="text-gray-500 fw-semibold fs-6">Enter your email to reset your password.</div>
        </div>
        <div class="fv-row mb-8">
            <input type="email"
                   id="email" class="form-control @error('email') is-invalid @enderror bg-transparent"
                   value="{{ old('email') }}"
                   placeholder="Email" name="email" autocomplete="off" required autofocus  />
            @if ($errors -> has('email'))
                <div class="invalid-feedback">
                    {{ $errors -> first('email') }}
                </div>
            @endif
        </div>
        <!--begin::Actions-->
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" class="btn btn-primary me-4">
                <span class="indicator-label">Submit</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
            <a href="{{ route('login') }}" class="btn btn-light">Cancel</a>
        </div>
    </form>
@endsection
