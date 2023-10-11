@extends('layouts.app')
@section('title', 'Results')
@section('css')

@endsection

@section('content')
    <x-breadcrum name="Results" page-name="View Result" />
    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                <x-label for="student_id">Student</x-label>
                                @if(auth()->user()->can('user.view'))
                                    <p><a href="{{ route('settings.users.show', $result->student->id) }}" target="_blank"> {{ $result->student->reg_number }} | {{ $result->student->name }}</a></p>
                                @else
                                    <p>{{ $result->student->reg_number }} | {{ $result->student->name }}</p>
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                <x-label for="semester_id">Semester</x-label>
                                @if(auth()->user()->can('semesters.view'))
                                    <p><a href="{{ route('semesters.show', $result->semester->id) }}" target="_blank"> {{ $result->semester->name }}</a> | {{ $result->semester->total_credit_hours }} credit hours</p>
                                @else
                                    <p>{{ $result->semester->name }} | {{ $result->semester->total_credit_hours }} credit hours</p>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                <x-label for="student_id">Semester GPA</x-label>
                                <p>{{ $result->cgpa }}</p>
                            </div>
                        </div>
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <div class="card-title">
                                    <h2>Semester Courses</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                                <div class="table-responsive">
                                    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded detail-table align-center">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                <th scope="col" class="text-center">Course</th>
                                                <th scope="col" class="text-center">Credit Hours</th>
                                                <th scope="col" class="text-center">Grade</th>
                                                <th scope="col" class="text-center">GPA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($result->resultCourses as $resultCourse)
                                                <tr>
                                                    @if(auth()->user()->can('courses.view'))
                                                        <td class="pe-0 text-center">
                                                            <a href="{{ route('courses.show', $resultCourse->course->id) }}" target="_blank"> {{ $resultCourse->course->code }} | {{ $resultCourse->course->title}}</a>
                                                        </td>
                                                    @else
                                                        <td class="text-center">{{ $resultCourse->course->code }} | {{ $resultCourse->course->title}}</td>
                                                    @endif
                                                    <td class="text-center">{{ $resultCourse->course->credit_hours }}</td>
                                                    <td class="text-center">{{ $resultCourse->grade }}</td>
                                                    <td class="text-center">{{ $resultCourse->gpa }}</td>
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
