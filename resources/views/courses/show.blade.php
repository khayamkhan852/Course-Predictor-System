@extends('layouts.app')
@section('title', 'Courses View')

@section('content')
    <x-breadcrum name="Courses" page-name="Course View" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="code">Code</x-label>
                                <p>{{ $course->code }}</p>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="title">Title</x-label>
                                <p>{{ $course->title }}</p>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="credit_hours">Credit Hours</x-label>
                                <p>{{ $course->credit_hours }}</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="course_level">Course Level</x-label>
                                <p>{{ $course->course_level }}</p>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="department_id">Department</x-label>
                                <p>{{ $course->department->name }}</p>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="course_id">Pre-requisite Course</x-label>
                                <p>{{ $course->pre_requisite_course->title }}</p>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                <x-label for="coordinator_id">Course Coordinator</x-label>
                                <p>{{ $course->coordinator->name }}</p>
                            </div>
                        </div>
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <div class="card-title">
                                    <h2>Sections Instructors</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed gy-5">
                                        <tbody class="fs-6 fw-semibold text-gray-600">
                                            @foreach($course->courseInstructors as $key => $instructor)
                                                <tr>
                                                    <td>{{ $instructor->section->name }}</td>
                                                    <td>{{ $instructor->instructor->name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection





