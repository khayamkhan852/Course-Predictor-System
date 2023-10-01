@extends('layouts.app')
@section('title', 'Course Registrations')
@section('css')

@endsection

@section('content')
    <x-breadcrum name="Course Registrations" page-name="New Course Registration" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('course-registrations.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="department_id" class="required">Student</x-label>
                                    <x-select-two name="student_id" id="student_id" message="Select Student">
                                        <option value=""></option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->id }}" {{ ( (old('student_id') ?? $student->id) == auth()->id()) ? 'selected' : '' }}>{{ $student->name }} : {{ $student->reg_number }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('student_id')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="department_id" class="required">Department</x-label>
                                    <x-select-two name="department_id" id="department_id" message="Select Student Department">
                                        <option value=""></option>
                                        @foreach($students as $student)
                                            <option value="{{ $student->department_id }}" {{ old('department_id') == $student->department_id ? 'selected' : '' }}>{{ $student->department->name }}</option>
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





