@extends('layouts.app')
@section('title', 'users')

@section('content')
    <x-breadcrum name="users" parent="1" parent-name="Settings" page-name="User" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <div class="row mb-10">
                            <div class="col-12">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('theme/assets/media/svg/avatars/blank.svg') }})">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $user->getFirstMediaUrl('users')?: asset('theme/assets/media/avatars/300-6.jpg') }})"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                                <x-label for="name">Name</x-label>
                                <p>{{ $user->name }}</p>
                            </div>
                            <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                                <x-label for="email">Email</x-label>
                                <p>{{ $user->email }}</p>
                            </div>
                            <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                                <x-label for="reg_number">Registration Number</x-label>
                                <p>{{ $user->reg_number ?? '----' }}</p>
                            </div>
                            <div class="col-sm-12 col-md-3 col-xl-3 col-lg-3 mb-10">
                                <x-label for="user_type_id">User Role</x-label> <br>
                                @foreach($user->roles as $role)
                                    <div class="badge badge-light-success fw-bold">{{ $role->name }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





