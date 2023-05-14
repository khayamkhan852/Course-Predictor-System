@extends('layouts.app')
@section('title', 'Semesters')

@section('content')
    <x-breadcrum name="Semesters" page-name="New Semester" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('semesters.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="name" class="required">Name</x-label>
                                    <x-input id="name" name="name" value="{{ old('name') }}" placeholder="Semester Name" autofocus />
                                    @error('name')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="year" class="required">Year</x-label>
                                    <x-input type="number" min="2000"  max="3099" step="1" id="year" name="year" value="{{ old('year') }}" placeholder="Year" />
                                    @error('year')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="total_credit_hours">Total Credit Hours</x-label>
                                    <x-input type="number" min="1" id="total_credit_hours" name="total_credit_hours" value="{{ old('total_credit_hours') }}" placeholder="Semester Total Credit Hours" />
                                    @error('total_credit_hours')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="department_id" class="required">Department</x-label>
                                    <x-select-two name="department_id" id="department_id" message="Select Course Department">
                                        <option value=""></option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" {{old('department_id') == $department->id ? 'selected' : ''}}>{{ $department->name }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('department_id')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <x-button class="btn-primary">Create New Semester</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





