@extends('layouts.app')
@section('title', 'Course Registrations')
@section('css')

@endsection

@section('content')
    <x-breadcrum name="Course Registrations" page-name="Registered Course View" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="student_id" class="fw-bold">Student</x-label>
                                <p>{{ $registeredCourses->student->name }}</p>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="student_id" class="fw-bold">Registration Number</x-label>
                                <p>{{ $registeredCourses->student->reg_number }}</p>
                            </div>
                            <div class="col-sm-12 col-md-4 col-xl-4 col-lg-4 mb-10">
                                <x-label for="department_id" class="fw-bold">Department</x-label>
                                <p>{{ $registeredCourses->student->department->name }}</p>

                            </div>
                        </div>
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <div class="card-title">
                                    <h2>Courses Registered</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                                <div class="table-responsive">
                                    <table class="table align-middle table-row-dashed fs-6 gy-4">
                                        <tbody class="fs-6 fw-semibold text-gray-600" id="semester_tbody">
                                            @foreach($registeredCourses->registrationSemesters as $semester)
                                                <tr class="text-success">
                                                    <th><b>{{ $semester->semester->name }}</b><td>
                                                    <th><b>{{ $semester->semester->year }}</b><td>
                                                    <th><b>{{ $semester->semester->total_credit_hours }} Total Credit Hours</b><td>
                                                </tr>
                                                @foreach($semester->registrationSemesterCourses as $course)
                                                    <tr>
                                                        <td>{{ $course->course->code }}<td>
                                                        <td>{{ $course->course->title }}<td>
                                                        <td>{{ $course->course->credit_hours }} Credit hours<td>
                                                    </tr>
                                                @endforeach
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
