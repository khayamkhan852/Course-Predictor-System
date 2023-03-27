@extends('admin.layouts.app')
@section('title', 'Partners')

@section('content')
    <x-breadcrum name="Partners" parent="1" parent-name="Settings" page-name="Edit Partner" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15" style="background-color:#F5F6FA;">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('admin.settings.partners.update', [$partner]) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-10">
                                <div class="col-12">
                                    <x-image-preloaded name="partner_image" url="{{ $partner->getFirstMediaUrl('partners') ?: asset('theme/assets/media/avatars/300-6.jpg') }}" />
                                </div>
                            </div>
                            @error('partner_image')
                                <x-error>{{ $message }}</x-error>
                            @enderror

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5">
                                    <x-label for="name" class="required">Name</x-label>
                                    <x-input class="{{ $errors -> has('name') ? 'is-invalid' : '' }}"
                                             id="name" name="name" value="{{ old('name')?: $partner->name }}" placeholder="Partner Name" autofocus required />
                                    @error('name')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5">
                                    <x-label for="email">Email</x-label>
                                    <x-input class="{{ $errors -> has('email') ? 'is-invalid' : '' }}"
                                             id="email" type="email" name="email" value="{{ old('email') ?: $partner->email }}"  placeholder="Partner Email" />
                                    @error('email')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="cell">Contact</x-label>
                                    <x-input class="{{ $errors -> has('cell') ? 'is-invalid' : '' }}" id="cell"
                                             name="cell" value="{{ old('cell') ?: $partner->cell }}" placeholder="Partner Contact" />
                                    @error('cell')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-6 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="branch_id" class="required">Branch</x-label>
                                    <x-select-two name="branch_id" id="branch_id" required>
                                        <option value=""></option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ ( (old('branch_id') ?? $partner->branch_id) == $branch->id) ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('branch_id')
                                    <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-10">
                                <div class="col-12">
                                    <x-label for="address">Address</x-label>
                                    <x-text-area rows="4" name="address" id="address">{{ old('address') ?: $partner->address }}</x-text-area>
                                    @error('address')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <x-button class="btn-primary">Update {{ $partner->name }}</x-button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection





