@extends('admin.layouts.app')
@section('title', 'Vehicle Groups')

@section('content')
    <x-breadcrum name="Vehicle Groups" parent="1" parent-name="Settings" page-name="edit Vehicle Group" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15" style="background-color:#F5F6FA;">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('admin.settings.vehicle-groups.update', $vehicleGroup) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5">
                                    <x-label for="type" class="required">Vehicle Group</x-label>
                                    <x-input class="{{ $errors -> has('group_name') ? 'is-invalid' : '' }}"
                                             id="group_name" name="group_name" value="{{ old('group_name') ?: $vehicleGroup->group_name }}" placeholder="Vehicle Group" autofocus required />
                                    @error('group_name')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5">
                                    <x-label for="branch_id" class="required">Branch</x-label>
                                    <x-select-two name="branch_id" id="branch_id" required>
                                        <option value=""></option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ ( (old('branch_id') ?? $vehicleGroup->branch_id) == $branch->id) ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('branch_id')
                                    <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-5 mt-8">
                                    <x-button class="btn-primary ms-4">Update {{ $vehicleGroup->group_name }}</x-button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection





