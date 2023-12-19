@extends('layouts.app')
@section('title', 'Courses')

@section('content')
    <x-breadcrum name="Courses" page-name="New Course" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="code" class="required">Code</x-label>
                                    <x-input id="code" name="code" value="{{ old('code') }}" placeholder="Course Code" autofocus />
                                    @error('code')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="title" class="required">Title</x-label>
                                    <x-input id="title" name="title" value="{{ old('title') }}" placeholder="Course Title" />
                                    @error('title')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="credit_hours" class="required">Credit Hours</x-label>
                                    <x-input type="number" min="1" id="credit_hours" name="credit_hours" value="{{ old('credit_hours') }}" placeholder="Course Credit Hours" />
                                    @error('credit_hours')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="course_level" class="required">Course Level</x-label>
                                    <x-select-two name="course_level" id="course_level" message="Select Course Level">
                                        <option value=""></option>
                                        <option value="BS" {{old('course_level') === 'BS' ? 'selected' : ''}}>BS</option>
                                        <option value="MS" {{old('course_level') === 'MS' ? 'selected' : ''}}>MS</option>
                                        <option value="PhD" {{old('course_level') === 'PhD' ? 'selected' : ''}}>PhD</option>
                                    </x-select-two>
                                    @error('course_level')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
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
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="course_id">Pre-requisite Course</x-label>
                                    <x-select-two name="course_id" id="course_id" message="Select a Pre-requisite Course, if any">
                                        <option value=""></option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{old('course_id') == $course->id ? 'selected' : ''}}>{{ $course->title }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('course_id')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="coordinator_id">Course Coordinator</x-label>
                                    <x-select-two name="coordinator_id" id="coordinator_id" message="Select Course Coordinator, if any">
                                        <option value=""></option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}" {{old('coordinator_id') == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('coordinator_id')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                    <x-label for="is_compulsory" class="required">Is Compulsory</x-label>
                                    <x-select-two name="is_compulsory" id="is_compulsory" message="Select Yes if compulsory">
                                        <option value=""></option>
                                        <option value="yes" {{ old('is_compulsory') == 'yes' ? 'selected' : ''}}>Yes</option>
                                        <option value="no" {{ old('is_compulsory') == 'no' ? 'selected' : ''}}>No</option>
                                    </x-select-two>
                                    @error('is_compulsory')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>

                            @foreach($sections as $key => $section)
                                <div class="row">
                                    <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                        <x-label for="section_id">Section</x-label>
                                        <x-select-two name="course_instructors[{{ $key }}][section_id]" id="section_id{{$key}}" message="Select Section">
                                            <option value=""></option>
                                            @foreach($sections as $section)
                                                <option value="{{ $section->id }}" {{old('course_instructors.' . $key . '.section_id') == $section->id ? 'selected' : ''}}>{{ $section->name }}</option>
                                            @endforeach
                                        </x-select-two>
                                        @error('course_instructors.' . $key . '.section_id')
                                            <x-error>{{ $message }}</x-error>
                                        @enderror
                                    </div>
                                    <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                        <x-label for="instructor_id" class="required">Course Instructors</x-label>
                                        <x-select-two name="course_instructors[{{ $key }}][instructor_id]" id="instructor_id{{$key}}" message="Select Course Instructor">
                                            <option value=""></option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{old('course_instructors.' . $key . '.instructor_id') == $user->id ? 'selected' : ''}}>{{ $user->name }}</option>
                                            @endforeach
                                        </x-select-two>
                                        @error('course_instructors.' . $key . '.instructor_id')
                                        <x-error>{{ $message }}</x-error>
                                        @enderror
                                    </div>
                                </div>
                            @endforeach

                            <x-button class="btn-primary">Create New Course</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





