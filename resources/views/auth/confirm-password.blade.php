@extends('auth.Layouts.app')
@section('title', 'confirm password')

@section('content')
    <form class="form w-100" method="POST" action="{{ route('password.confirm') }}">
        @csrf
        <div class="text-center mb-10">
            <h1 class="text-dark fw-bolder mb-3">Confirm Your Password ?</h1>
            <div class="text-gray-500 fw-semibold fs-6">Enter Your Password Again.</div>
        </div>
        <div class="fv-row mb-8">
            <input type="password"
                   id="password" class="form-control @error('password') is-invalid @enderror bg-transparent"
                   placeholder="Email" name="password" autocomplete="off" required autofocus  />
            @if ($errors -> has('password'))
                <div class="invalid-feedback">
                    {{ $errors -> first('password') }}
                </div>
            @endif
        </div>
        <div class="d-flex flex-wrap justify-content-center pb-lg-0">
            <button type="submit" class="btn btn-primary me-4">
                <span class="indicator-label"> {{ __('Confirm') }}</span>
                <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                </span>
            </button>
        </div>
    </form>
@endsection
