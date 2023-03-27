@extends('auth.Layouts.app')
@section('title', 'login')
@section('content')
    <form class="form w-100" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="text-center mb-11">
            <h1 class="text-dark fw-bolder mb-3">Sign In</h1>
            <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
        </div>
        <div class="fv-row mb-8">
            <input type="email" id="email"
                   class="form-control @error('email') is-invalid @enderror  bg-transparent"
                   placeholder="Email" name="email" value="{{ old('email') }}" autocomplete="off" autofocus required />
            @if ($errors -> has('email'))
                <div class="invalid-feedback">
                    {{ $errors -> first('email') }}
                </div>
            @endif
        </div>
        <div class="fv-row mb-3">
            <input type="password" id="password"
                   class="form-control @error('password') is-invalid @enderror bg-transparent"
                   placeholder="Password" name="password" autocomplete="off" required />
            @if ($errors -> has('password'))
                <div class="invalid-feedback">
                    {{ $errors -> first('password') }}
                </div>
            @endif
        </div>
        @if(Route::has('password.request'))
            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                <div></div>
                <a href="{{ route('password.request') }}" class="link-primary">{{ __('Forgot your password?') }}</a>
            </div>
        @endif
        <div class="d-grid mb-10">
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">Sign In</span>
                <span class="indicator-progress">Please wait...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
        <div class="text-gray-500 text-center fw-semibold fs-6">Not a Member yet?
            <a href="{{ route('register') }}" class="link-primary">Sign up</a>
        </div>
    </form>
@endsection
