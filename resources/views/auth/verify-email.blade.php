@extends('auth.Layouts.app')
@section('title', 'Verify Email')

@section('content')
    <div class="text-center mb-10">
        <h1 class="text-dark fw-bolder mb-3">Confirm Email</h1>
        <div class="text-gray-500 fw-semibold fs-6">
            @if(session('status') === 'verification-link-sent')
                New Verification Link Send.
            @else
                Verify Your Email Address.
            @endif
        </div>
    </div>
    <form  class="form w-100" method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div class="d-grid mb-10">
            <button type="submit" class="btn btn-primary">
                <span class="indicator-label">{{ __('Resend Verification Email') }}</span>
            </button>
        </div>
    </form>
    <form  class="form w-100"  method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="d-grid mb-10">
            <button type="submit" class="btn btn-danger">
                <span class="indicator-label">{{ __('Log Out') }}</span>
            </button>
        </div>
    </form>
@endsection
