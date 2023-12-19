@extends('layouts.app')
@section('title', 'Recommendation')
@section('css')

@endsection

@section('content')
    <x-breadcrum name="Recommendation" page-name="Recommended Subjects" />

    <div class="docs-content d-flex flex-column flex-column-fluid">
        <div class="container d-flex flex-column flex-lg-row">
            <div class="card card-docs flex-row-fluid mb-2 bg-gray-100">
                <div class="card-body fs-6 py-15 px-10 py-lg-15 px-lg-15">
                    <div class="pb-10">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-xl-6 col-lg-6 mb-10">
                                <x-label for="student_id">Student</x-label>
                                @if(auth()->user()->can('user.view'))
                                    <p><a href="{{ route('settings.users.show', auth()->id()) }}" target="_blank"> {{ auth()->user()->reg_number }} | {{ auth()->user()->name }}</a></p>
                                @else
                                    <p>{{ auth()->user()->reg_number }} | {{ auth()->user()->name }}</p>
                                @endif
                            </div>
                        </div>
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <div class="card-title">
                                    <h2>Compulsory Courses To Take</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                                <div class="table-responsive">
                                    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded detail-table align-center">
                                        <thead>
                                            <tr class="fw-bold fs-6 text-gray-800 px-7">
                                                <th scope="col" class="text-center">Course</th>
                                                <th scope="col" class="text-center">Grade</th>
                                                <th scope="col" class="text-center">GPA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse($compulsory_courses_to_take as $result)
                                                @foreach($result->resultCourses as $resultCourse)
                                                    <tr>
                                                        @if(auth()->user()->can('courses.view'))
                                                            <td class="pe-0 text-center">
                                                                <a href="{{ route('courses.show', $resultCourse->course->id) }}" target="_blank"> {{ $resultCourse->course->code }} | {{ $resultCourse->course->title}}</a>
                                                            </td>
                                                        @else
                                                            <td class="text-center">{{ $resultCourse->course->code }} | {{ $resultCourse->course->title}}</td>
                                                        @endif
                                                        <td class="text-center">{{ $resultCourse->grade }}</td>
                                                        <td class="text-center">{{ $resultCourse->gpa }}</td>
                                                    </tr>
                                                @endforeach
                                            @empty
                                                <tr>
                                                    <td class="text-center" colspan="3">No Compulsory Subjects to Take</td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card pt-4 mb-6 mb-xl-9">
                            <div class="card-header border-0">
                                <div class="card-title">
                                    <h2>Not Compulsory Courses To Take</h2>
                                </div>
                            </div>
                            <div class="card-body pt-0 pb-5">
                                <div class="table-responsive">
                                    <table class="table table-striped table-row-bordered gy-5 gs-7 border rounded detail-table align-center">
                                        <thead>
                                        <tr class="fw-bold fs-6 text-gray-800 px-7">
                                            <th scope="col" class="text-center">Course</th>
                                            <th scope="col" class="text-center">Grade</th>
                                            <th scope="col" class="text-center">GPA</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($compulsory_not_courses_to_take as $result)
                                            @foreach($result->resultCourses as $resultCourse)
                                                <tr>
                                                    @if(auth()->user()->can('courses.view'))
                                                        <td class="pe-0 text-center">
                                                            <a href="{{ route('courses.show', $resultCourse->course->id) }}" target="_blank"> {{ $resultCourse->course->code }} | {{ $resultCourse->course->title}}</a>
                                                        </td>
                                                    @else
                                                        <td class="text-center">{{ $resultCourse->course->code }} | {{ $resultCourse->course->title}}</td>
                                                    @endif
                                                    <td class="text-center">{{ $resultCourse->grade }}</td>
                                                    <td class="text-center">{{ $resultCourse->gpa }}</td>
                                                </tr>
                                            @endforeach
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="3">No Compulsory Subjects to Take</td>
                                            </tr>
                                        @endforelse
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
