@extends('layouts.app')
@section('title', 'Assign Courses')

@section('content')
    <x-breadcrum name="Semesters" page-name="Assign Courses To {{ $semester->name }}" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">

                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <form class="form w-100" action="{{ route('semesters.assign.courses', $semester) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-xl-12 col-lg-12 mb-10">
                                    <x-label for="department_id" class="required">Courses</x-label>
                                    <x-select-two name="course_id[]" id="course_id" message="Select Courses to Assign" multiple="1">
                                        <option value=""></option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ (old('course_id') && in_array($course->id, old('course_id'))) || (empty(old('course_id')) && in_array($course->id, $semester->courses->pluck('id')->toArray()))  ? 'selected' : '' }}>{{ $course->title }}</option>
                                        @endforeach
                                    </x-select-two>
                                    @error('course_id')
                                        <x-error>{{ $message }}</x-error>
                                    @enderror
                                </div>
                            </div>
                            <x-button class="btn-primary">Assign Selected Courses to {{ $semester->name }}</x-button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection




