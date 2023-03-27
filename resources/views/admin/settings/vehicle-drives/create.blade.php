@extends('admin.layouts.app')
@section('title', 'Vehicle Drives')

@section('content')
    <x-breadcrum name="Vehicle Drives" parent="1" parent-name="Settings" page-name="New Vehicle Drive" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15" style="background-color:#F5F6FA;">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('admin.settings.vehicle-drives.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5">
                                    <x-label for="vehicle_drive" class="required">Vehicle Drive</x-label>
                                    <x-input class="{{ $errors -> has('vehicle_drive') ? 'is-invalid' : '' }}"
                                             id="vehicle_drive" name="vehicle_drive" value="{{ old('vehicle_drive') }}" placeholder="Vehicle Drive" autofocus required />
                                    @error('vehicle_drive')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5">
                                    <x-label for="branch_id" class="required">Branch</x-label>
                                    <x-select-two name="branch_id" id="branch_id" required>
                                        <option value=""></option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{old('branch_id')== $branch->id ? 'selected' : ''}}>{{ $branch->name }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('branch_id')
                                    <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5 mt-8">
                                    <x-button class="btn-primary ms-4">Save Vehicle Drive</x-button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




