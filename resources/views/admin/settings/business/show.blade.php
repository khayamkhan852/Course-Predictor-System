@extends('admin.layouts.app')
@section('title', 'business settings')

@section('content')
    <x-breadcrum name="Businesses" parent="1" parent-name="Settings" page-name="Business View" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15" style="background-color:#F5F6FA;">
                    <div class="pb-10">
                        <div class="row mb-10">
                            <div class="col-12">
                                <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url({{ asset('theme/assets/media/svg/avatars/blank.svg') }})">
                                    <div class="image-input-wrapper w-125px h-125px" style="background-image: url({{ $businessSetting->getFirstMediaUrl('businesses') }})"></div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5">
                                <x-label for="name">Name</x-label>
                                <p>{{ $businessSetting->name }}</p>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5">
                                <x-label for="email" class="bold">Email</x-label>
                                <p>{{ $businessSetting->email }}</p>
                            </div>
                        </div>
                        <div class="separator my-2 mb-5"></div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                <x-label for="contact_one">Contact One</x-label>
                                <p>{{ $businessSetting->contact_one }}</p>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                <x-label for="contact_two">Contact Two</x-label>
                                <p>{{ $businessSetting->contact_two }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                <x-label for="licence_number">Licence Number</x-label>
                                <p>{{ $businessSetting->licence_number }}</p>
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                <x-label for="website_url">Website</x-label>
                                <p>{{ $businessSetting->website_url }}</p>

                            </div>
                        </div>

                        <div class="row mb-10">
                            <div class="col-12">
                                <x-label for="address">Address</x-label>
                                <p>{{ $businessSetting->address }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





